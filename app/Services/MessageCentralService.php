<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class MessageCentralService
{
    private $baseUrl = 'https://cpaas.messagecentral.com';
    private $customerId;
    private $authToken;
    private $senderId;

    public function __construct()
    {
        $this->customerId = config('services.message_central.customer_id');
        $this->authToken = config('services.message_central.auth_token');
        // Sender ID is optional - Message Central may use a default if not provided
        $this->senderId = config('services.message_central.sender_id');

        // Validate credentials are set
        if (empty($this->customerId) || empty($this->authToken)) {
            Log::warning('Message Central credentials not fully configured', [
                'has_customer_id' => !empty($this->customerId),
                'has_auth_token' => !empty($this->authToken)
            ]);
        }
    }

    /**
     * Send OTP SMS via Message Central
     * Note: Message Central Verify Now API generates OTP automatically
     *
     * @param string $mobileNumber Phone number (without country code)
     * @param string $countryCode Country code (e.g., '1' for US, '91' for India)
     * @param string|null $otp Not used - Message Central generates OTP automatically
     * @param string|null $message Not used - Message Central uses default template
     * @return array
     */
    public function sendOTP($mobileNumber, $countryCode, $otp = null, $message = null)
    {
        try {
            // Format phone number (remove any non-numeric characters)
            $mobileNumber = preg_replace('/[^\d]/', '', $mobileNumber);

            $endpoint = $this->baseUrl . '/verification/v3/send';

            // Message Central Verify Now API format (as per documentation)
            // OTP is generated automatically by Message Central
            $queryParams = [
                'customerId' => $this->customerId,
                'flowType' => 'SMS',
                'mobileNumber' => $mobileNumber,
                'countryCode' => $countryCode
            ];

            // Note: senderId, message, messageType are not needed for Verify Now API
            // Message Central uses default templates and generates OTP automatically

            $fullUrl = $endpoint . '?' . http_build_query($queryParams);

            // Log the request for debugging (without sensitive data)
            Log::info('Message Central API Request', [
                'endpoint' => $endpoint,
                'customer_id' => $this->customerId,
                'mobile' => $mobileNumber,
                'country_code' => $countryCode,
                'has_sender_id' => !empty($this->senderId),
                'message_length' => strlen($message)
            ]);

            // Message Central expects authToken header (case-sensitive)
            $response = Http::withHeaders([
                'authToken' => trim($this->authToken),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ])->post($fullUrl);

            $statusCode = $response->status();
            $responseData = $response->json();
            $rawBody = $response->body();

            // Log full response for debugging
            Log::info('Message Central API Response', [
                'status_code' => $statusCode,
                'response' => $responseData,
                'raw_body' => $rawBody,
                'headers' => $response->headers()
            ]);

            // Handle non-JSON responses
            if (!$responseData && !empty($rawBody)) {
                Log::error('Message Central non-JSON response', [
                    'raw_body' => $rawBody,
                    'status_code' => $statusCode
                ]);

                return [
                    'success' => false,
                    'message' => 'Invalid response from Message Central API: ' . substr($rawBody, 0, 200),
                    'error' => ['raw_response' => $rawBody]
                ];
            }

            // Extract error message from various possible locations in response
            $errorMessage = null;
            $responseCode = null;

            if (is_array($responseData)) {
                $errorMessage = $responseData['message']
                    ?? $responseData['errorMessage']
                    ?? $responseData['error']
                    ?? $responseData['msg']
                    ?? (isset($responseData['data']['errorMessage']) ? $responseData['data']['errorMessage'] : null)
                    ?? null;

                $responseCode = $responseData['responseCode']
                    ?? $responseData['code']
                    ?? $responseData['status']
                    ?? (isset($responseData['data']['responseCode']) ? $responseData['data']['responseCode'] : null)
                    ?? null;
            }

            // Check if response is successful first
            if ($response->successful() && $responseCode == 200) {
                // Extract verification ID from response
                $verificationId = $responseData['data']['verificationId']
                    ?? $responseData['verificationId']
                    ?? $responseData['data']['id']
                    ?? null;

                $transactionId = $responseData['data']['transactionId']
                    ?? $responseData['transactionId']
                    ?? null;

                Log::info('Message Central OTP sent successfully', [
                    'mobile' => $mobileNumber,
                    'verification_id' => $verificationId,
                    'transaction_id' => $transactionId
                ]);

                return [
                    'success' => true,
                    'message' => 'OTP sent successfully',
                    'transaction_id' => $transactionId,
                    'verification_id' => $verificationId
                ];
            } else {
                // Build comprehensive error message
                $finalErrorMessage = $errorMessage ?? 'Unknown error occurred';

                // If we have response data, include more details
                if (is_array($responseData) && !empty($responseData)) {
                    $finalErrorMessage .= ' (Response: ' . json_encode($responseData) . ')';
                } elseif (!empty($rawBody)) {
                    $finalErrorMessage .= ' (Raw: ' . substr($rawBody, 0, 200) . ')';
                }

                Log::error('Message Central OTP send failed', [
                    'mobile' => $mobileNumber,
                    'error' => $finalErrorMessage,
                    'response_code' => $responseCode,
                    'http_status' => $statusCode,
                    'full_response' => $responseData,
                    'raw_body' => $rawBody
                ]);

                // Provide user-friendly error message based on response code
                $userMessage = $errorMessage ?? 'Failed to send OTP. Please check your account settings and try again.';
                $errorType = null;

                // Handle specific Message Central response codes first
                if ($responseCode == 508 || ($errorMessage && stripos($errorMessage, 'insufficient credits') !== false)) {
                    // Actual balance/credit issue - only this should trigger balance error
                    $userMessage = 'Insufficient credits in your Message Central account. Please top up credits in your Message Central account dashboard.';
                    $errorType = 'balance';
                    Log::error('Message Central insufficient credits error', [
                        'mobile' => $mobileNumber,
                        'error' => $errorMessage,
                        'response' => $responseData,
                        'suggestion' => 'Please top up credits in your Message Central account dashboard'
                    ]);
                } elseif ($responseCode == 913 || ($errorMessage && stripos($errorMessage, 'SMS_SUBSCRIPTION_NOT_ACTIVE') !== false)) {
                    // SMS subscription not active
                    $userMessage = 'SMS subscription is not active in your Message Central account. Please activate your SMS subscription from the Message Central dashboard.';
                    $errorType = 'subscription';
                    Log::error('Message Central SMS subscription not active', [
                        'mobile' => $mobileNumber,
                        'error' => $errorMessage,
                        'response' => $responseData,
                        'suggestion' => 'Activate SMS subscription in Message Central dashboard'
                    ]);
                } elseif ($responseCode == 400 || ($errorMessage && stripos($errorMessage, 'pricing not found') !== false)) {
                    // Pricing configuration issue - NOT a balance issue
                    $userMessage = 'Pricing not configured for this destination in your Message Central account. Please configure pricing for this country/carrier in your Message Central dashboard.';
                    $errorType = 'pricing';
                    Log::error('Message Central pricing not found error', [
                        'mobile' => $mobileNumber,
                        'country_code' => $countryCode,
                        'error' => $errorMessage,
                        'response' => $responseData,
                        'suggestion' => 'Configure pricing for country code ' . $countryCode . ' in Message Central dashboard'
                    ]);
                } elseif ($statusCode == 401) {
                    // Authentication failed
                    $userMessage = 'Authentication failed. Your Message Central auth token may be expired or invalid. Please generate a new token from your Message Central dashboard and update it in your configuration.';
                    $errorType = 'authentication';
                    Log::error('Message Central 401 Authentication Error', [
                        'customer_id' => $this->customerId,
                        'token_preview' => substr($this->authToken, 0, 20) . '...',
                        'token_length' => strlen($this->authToken),
                        'suggestion' => 'Token may be expired. Generate new token from Message Central dashboard.'
                    ]);
                } elseif ($statusCode == 403) {
                    $userMessage = 'Access denied. Please verify your Message Central account permissions.';
                    $errorType = 'permission';
                } elseif ($statusCode >= 500) {
                    $userMessage = 'Message Central service error. Please try again later.';
                    $errorType = 'server_error';
                }

                return [
                    'success' => false,
                    'message' => $userMessage,
                    'error' => $responseData,
                    'error_type' => $errorType,
                    'response_code' => $responseCode,
                    'http_status' => $statusCode,
                    'debug_info' => [
                        'raw_response' => $rawBody,
                        'parsed_response' => $responseData
                    ]
                ];
            }
        } catch (Exception $e) {
            Log::error('Message Central OTP exception', [
                'mobile' => $mobileNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to send OTP: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Validate OTP
     *
     * @param string $mobileNumber Phone number
     * @param string $countryCode Country code
     * @param string $otp OTP to validate
     * @param string|null $verificationId Verification ID from send response
     * @return array
     */
    public function validateOTP($mobileNumber, $countryCode, $otp, $verificationId = null)
    {
        try {
            $mobileNumber = preg_replace('/[^\d]/', '', $mobileNumber);
            
            // Clean OTP - remove any spaces, dashes, or other characters, keep only digits
            $otp = preg_replace('/[^\d]/', '', trim($otp));

            // Message Central verification endpoint (as per documentation)
            $endpoint = $this->baseUrl . '/verification/v3/validateOtp';

            // Build request parameters as per Message Central API documentation
            // Required: verificationId (Long), code (String), flowType (String)
            // Optional: langid (String) - for language support
            // NOTE: customerId is NOT required for validate endpoint (only for send)
            $params = [
                'verificationId' => $verificationId, // Required: Long - from /send API response
                'code' => $otp, // Required: String - OTP code (parameter name is 'code' not 'otp'!)
                'flowType' => 'SMS' // Required: String - same as used in send
                // langid is optional - default is English
            ];

            // Check if verificationId is provided (mandatory)
            if (empty($verificationId)) {
                Log::error('Message Central OTP validation failed - verificationId is required', [
                    'mobile' => $mobileNumber
                ]);
                
                return [
                    'success' => false,
                    'message' => 'Verification ID is required. Please send OTP again.'
                ];
            }

            Log::info('Message Central OTP validation request', [
                'endpoint' => $endpoint,
                'verification_id' => $verificationId,
                'code_length' => strlen($otp),
                'flow_type' => 'SMS',
                'params' => ['verificationId' => $verificationId, 'code' => '****', 'flowType' => 'SMS']
            ]);

            // As per documentation cURL example: It uses GET method (no --request POST flag)
            // Build URL with query parameters
            $fullUrl = $endpoint . '?' . http_build_query($params);
            
            Log::info('Message Central validation URL and params', [
                'full_url' => $fullUrl,
                'endpoint' => $endpoint,
                'method' => 'GET (as per cURL example)',
                'params' => ['verificationId' => $verificationId, 'code' => '****', 'flowType' => 'SMS'],
                'token_preview' => substr($this->authToken, 0, 20) . '...',
                'token_length' => strlen($this->authToken)
            ]);
            
            // As per documentation cURL example: NO --request POST flag = GET method
            // The cURL shows: curl --location 'url?params' --header 'authToken:...'
            // This means it's a GET request, not POST!
            $response = Http::withHeaders([
                'authToken' => trim($this->authToken),
                'Accept' => 'application/json'
            ])->get($fullUrl);
            
            Log::info('Message Central validation GET attempt', [
                'status' => $response->status(),
                'response_preview' => substr($response->body(), 0, 200),
                'headers' => $response->headers()
            ]);
            
            // If GET fails with 401, try POST (documentation text says POST but cURL shows GET)
            if ($response->status() == 401) {
                Log::warning('GET method returned 401, trying POST method', [
                    'verification_id' => $verificationId,
                    'url' => $fullUrl
                ]);
                
                $response = Http::withHeaders([
                    'authToken' => trim($this->authToken),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])->post($fullUrl);
                
                Log::info('Message Central validation POST attempt', [
                    'status' => $response->status(),
                    'response_preview' => substr($response->body(), 0, 200)
                ]);
            }

            $statusCode = $response->status();
            $responseData = $response->json();
            $rawBody = $response->body();

            Log::info('Message Central OTP validation response', [
                'status_code' => $statusCode,
                'response' => $responseData,
                'raw_body' => $rawBody
            ]);

            if ($response->successful() && isset($responseData['responseCode']) && $responseData['responseCode'] == 200) {
                Log::info('Message Central OTP validated successfully', [
                    'mobile' => $mobileNumber,
                    'verification_id' => $verificationId
                ]);

                return [
                    'success' => true,
                    'message' => 'OTP validated successfully'
                ];
            } else {
                // Handle 401 authentication error specifically
                if ($statusCode == 401) {
                    Log::error('Message Central OTP validation - Authentication failed', [
                        'mobile' => $mobileNumber,
                        'country_code' => $countryCode,
                        'verification_id' => $verificationId,
                        'http_status' => $statusCode,
                        'raw_body' => $rawBody,
                        'suggestion' => 'Auth token may be expired or invalid for validation endpoint'
                    ]);

                    return [
                        'success' => false,
                        'message' => 'Authentication failed. Please try again or contact support.'
                    ];
                }

                $errorMessage = $responseData['message']
                    ?? $responseData['errorMessage']
                    ?? $responseData['error']
                    ?? ($statusCode == 401 ? 'Authentication failed' : 'Invalid OTP');

                Log::error('Message Central OTP validation failed', [
                    'mobile' => $mobileNumber,
                    'country_code' => $countryCode,
                    'verification_id' => $verificationId,
                    'error' => $errorMessage,
                    'response_code' => $responseData['responseCode'] ?? null,
                    'http_status' => $statusCode,
                    'full_response' => $responseData,
                    'raw_body' => $rawBody
                ]);

                return [
                    'success' => false,
                    'message' => $errorMessage
                ];
            }
        } catch (Exception $e) {
            Log::error('Message Central OTP validation exception', [
                'mobile' => $mobileNumber,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to validate OTP: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Format phone number and extract country code
     *
     * @param string $phoneNumber
     * @return array ['number' => string, 'country_code' => string]
     */
    public function formatPhoneNumber($phoneNumber)
    {
        // Remove spaces and special characters, but keep + for detection
        $original = $phoneNumber;
        $hasPlus = str_starts_with($phoneNumber, '+');
        $cleaned = preg_replace('/[^\d+]/', '', $phoneNumber);

        // Common country codes mapping (1-3 digits)
        $countryCodes = [
            '1' => ['US', 'CA'],      // USA, Canada
            '7' => ['RU', 'KZ'],      // Russia, Kazakhstan
            '20' => ['EG'],           // Egypt
            '27' => ['ZA'],           // South Africa
            '30' => ['GR'],           // Greece
            '31' => ['NL'],           // Netherlands
            '32' => ['BE'],           // Belgium
            '33' => ['FR'],           // France
            '34' => ['ES'],           // Spain
            '39' => ['IT'],           // Italy
            '40' => ['RO'],           // Romania
            '41' => ['CH'],           // Switzerland
            '44' => ['GB'],           // UK
            '45' => ['DK'],           // Denmark
            '46' => ['SE'],           // Sweden
            '47' => ['NO'],           // Norway
            '48' => ['PL'],           // Poland
            '49' => ['DE'],           // Germany
            '51' => ['PE'],           // Peru
            '52' => ['MX'],           // Mexico
            '54' => ['AR'],           // Argentina
            '55' => ['BR'],           // Brazil
            '60' => ['MY'],           // Malaysia
            '61' => ['AU'],           // Australia
            '62' => ['ID'],           // Indonesia
            '63' => ['PH'],           // Philippines
            '64' => ['NZ'],           // New Zealand
            '65' => ['SG'],           // Singapore
            '66' => ['TH'],           // Thailand
            '81' => ['JP'],           // Japan
            '82' => ['KR'],           // South Korea
            '84' => ['VN'],           // Vietnam
            '86' => ['CN'],           // China
            '90' => ['TR'],           // Turkey
            '91' => ['IN'],           // India
            '92' => ['PK'],           // Pakistan
            '93' => ['AF'],           // Afghanistan
            '94' => ['LK'],           // Sri Lanka
            '95' => ['MM'],           // Myanmar
            '98' => ['IR'],           // Iran
            '212' => ['MA'],          // Morocco
            '213' => ['DZ'],          // Algeria
            '216' => ['TN'],          // Tunisia
            '218' => ['LY'],          // Libya
            '220' => ['GM'],          // Gambia
            '221' => ['SN'],          // Senegal
            '222' => ['MR'],          // Mauritania
            '223' => ['ML'],          // Mali
            '224' => ['GN'],          // Guinea
            '225' => ['CI'],          // Ivory Coast
            '226' => ['BF'],          // Burkina Faso
            '227' => ['NE'],          // Niger
            '228' => ['TG'],          // Togo
            '229' => ['BJ'],          // Benin
            '230' => ['MU'],          // Mauritius
            '231' => ['LR'],          // Liberia
            '232' => ['SL'],          // Sierra Leone
            '233' => ['GH'],          // Ghana
            '234' => ['NG'],          // Nigeria
            '235' => ['TD'],          // Chad
            '236' => ['CF'],          // Central African Republic
            '237' => ['CM'],          // Cameroon
            '238' => ['CV'],          // Cape Verde
            '239' => ['ST'],          // São Tomé and Príncipe
            '240' => ['GQ'],          // Equatorial Guinea
            '241' => ['GA'],          // Gabon
            '242' => ['CG'],          // Republic of the Congo
            '243' => ['CD'],          // Democratic Republic of the Congo
            '244' => ['AO'],          // Angola
            '245' => ['GW'],          // Guinea-Bissau
            '246' => ['IO'],          // British Indian Ocean Territory
            '248' => ['SC'],          // Seychelles
            '249' => ['SD'],          // Sudan
            '250' => ['RW'],          // Rwanda
            '251' => ['ET'],          // Ethiopia
            '252' => ['SO'],          // Somalia
            '253' => ['DJ'],          // Djibouti
            '254' => ['KE'],          // Kenya
            '255' => ['TZ'],          // Tanzania
            '256' => ['UG'],          // Uganda
            '257' => ['BI'],          // Burundi
            '258' => ['MZ'],          // Mozambique
            '260' => ['ZM'],          // Zambia
            '261' => ['MG'],          // Madagascar
            '262' => ['RE', 'YT'],    // Réunion, Mayotte
            '263' => ['ZW'],          // Zimbabwe
            '264' => ['NA'],          // Namibia
            '265' => ['MW'],          // Malawi
            '266' => ['LS'],          // Lesotho
            '267' => ['BW'],          // Botswana
            '268' => ['SZ'],          // Eswatini
            '269' => ['KM'],          // Comoros
            '290' => ['SH'],          // Saint Helena
            '291' => ['ER'],          // Eritrea
            '297' => ['AW'],          // Aruba
            '298' => ['FO'],          // Faroe Islands
            '299' => ['GL'],          // Greenland
            '350' => ['GI'],          // Gibraltar
            '351' => ['PT'],          // Portugal
            '352' => ['LU'],          // Luxembourg
            '353' => ['IE'],          // Ireland
            '354' => ['IS'],          // Iceland
            '355' => ['AL'],          // Albania
            '356' => ['MT'],          // Malta
            '357' => ['CY'],          // Cyprus
            '358' => ['FI'],          // Finland
            '359' => ['BG'],          // Bulgaria
            '370' => ['LT'],          // Lithuania
            '371' => ['LV'],          // Latvia
            '372' => ['EE'],          // Estonia
            '373' => ['MD'],          // Moldova
            '374' => ['AM'],          // Armenia
            '375' => ['BY'],          // Belarus
            '376' => ['AD'],          // Andorra
            '377' => ['MC'],          // Monaco
            '378' => ['SM'],          // San Marino
            '380' => ['UA'],          // Ukraine
            '381' => ['RS'],          // Serbia
            '382' => ['ME'],          // Montenegro
            '383' => ['XK'],          // Kosovo
            '385' => ['HR'],          // Croatia
            '386' => ['SI'],          // Slovenia
            '387' => ['BA'],          // Bosnia and Herzegovina
            '389' => ['MK'],          // North Macedonia
            '420' => ['CZ'],          // Czech Republic
            '421' => ['SK'],          // Slovakia
            '423' => ['LI'],          // Liechtenstein
            '500' => ['FK'],          // Falkland Islands
            '501' => ['BZ'],          // Belize
            '502' => ['GT'],          // Guatemala
            '503' => ['SV'],          // El Salvador
            '504' => ['HN'],          // Honduras
            '505' => ['NI'],          // Nicaragua
            '506' => ['CR'],          // Costa Rica
            '507' => ['PA'],          // Panama
            '508' => ['PM'],          // Saint Pierre and Miquelon
            '509' => ['HT'],          // Haiti
            '590' => ['GP', 'BL', 'MF'], // Guadeloupe, Saint Barthélemy, Saint Martin
            '591' => ['BO'],          // Bolivia
            '592' => ['GY'],          // Guyana
            '593' => ['EC'],          // Ecuador
            '594' => ['GF'],          // French Guiana
            '595' => ['PY'],          // Paraguay
            '596' => ['MQ'],          // Martinique
            '597' => ['SR'],          // Suriname
            '598' => ['UY'],          // Uruguay
            '599' => ['CW', 'BQ'],    // Curaçao, Caribbean Netherlands
            '670' => ['TL'],          // East Timor
            '672' => ['NF', 'AQ'],    // Norfolk Island, Antarctica
            '673' => ['BN'],          // Brunei
            '674' => ['NR'],          // Nauru
            '675' => ['PG'],          // Papua New Guinea
            '676' => ['TO'],          // Tonga
            '677' => ['SB'],          // Solomon Islands
            '678' => ['VU'],          // Vanuatu
            '679' => ['FJ'],          // Fiji
            '680' => ['PW'],          // Palau
            '681' => ['WF'],          // Wallis and Futuna
            '682' => ['CK'],          // Cook Islands
            '683' => ['NU'],          // Niue
            '685' => ['WS'],          // Samoa
            '686' => ['KI'],          // Kiribati
            '687' => ['NC'],          // New Caledonia
            '688' => ['TV'],          // Tuvalu
            '689' => ['PF'],          // French Polynesia
            '690' => ['TK'],          // Tokelau
            '691' => ['FM'],          // Micronesia
            '692' => ['MH'],          // Marshall Islands
            '850' => ['KP'],          // North Korea
            '852' => ['HK'],          // Hong Kong
            '853' => ['MO'],          // Macau
            '855' => ['KH'],          // Cambodia
            '856' => ['LA'],          // Laos
            '880' => ['BD'],          // Bangladesh
            '886' => ['TW'],          // Taiwan
            '960' => ['MV'],          // Maldives
            '961' => ['LB'],          // Lebanon
            '962' => ['JO'],          // Jordan
            '963' => ['SY'],          // Syria
            '964' => ['IQ'],          // Iraq
            '965' => ['KW'],          // Kuwait
            '966' => ['SA'],          // Saudi Arabia
            '967' => ['YE'],          // Yemen
            '968' => ['OM'],          // Oman
            '970' => ['PS'],          // Palestine
            '971' => ['AE'],          // UAE
            '972' => ['IL'],          // Israel
            '973' => ['BH'],          // Bahrain
            '974' => ['QA'],          // Qatar
            '975' => ['BT'],          // Bhutan
            '976' => ['MN'],          // Mongolia
            '977' => ['NP'],          // Nepal
            '992' => ['TJ'],          // Tajikistan
            '993' => ['TM'],          // Turkmenistan
            '994' => ['AZ'],          // Azerbaijan
            '995' => ['GE'],          // Georgia
            '996' => ['KG'],          // Kyrgyzstan
            '998' => ['UZ'],          // Uzbekistan
        ];

        // Remove + if present
        if ($hasPlus) {
            $cleaned = ltrim($cleaned, '+');
        }

        // Try to detect country code
        $countryCode = '1'; // Default to US
        $number = $cleaned;

        // Special handling for Pakistani numbers starting with 0 (local format)
        // Pakistani numbers: 0XXXXXXXXX (11 digits) = 92XXXXXXXXXX (12 digits with country code)
        if (str_starts_with($cleaned, '0') && strlen($cleaned) == 11) {
            // This is a Pakistani number in local format (starts with 0)
            $countryCode = '92';
            $number = substr($cleaned, 1); // Remove the leading 0
        } else {
            // Check for known country codes (1-3 digits)
            foreach ($countryCodes as $code => $countries) {
                $codeLength = strlen($code);
                if (str_starts_with($cleaned, $code) && strlen($cleaned) > $codeLength) {
                    // Verify it's a valid match (not just a prefix)
                    $remaining = substr($cleaned, $codeLength);
                    // Most countries have 7-10 digits after country code
                    if (strlen($remaining) >= 7 && strlen($remaining) <= 10) {
                        $countryCode = $code;
                        $number = $remaining;
                        break;
                    }
                }
            }

            // Special handling for common cases
            // US/Canada: 10 digits or 11 digits starting with 1
            if ($countryCode == '1' && strlen($cleaned) == 10) {
                $countryCode = '1';
                $number = $cleaned;
            } elseif ($countryCode == '1' && strlen($cleaned) == 11 && str_starts_with($cleaned, '1')) {
                $countryCode = '1';
                $number = substr($cleaned, 1);
            }
        }

        Log::info('Phone number formatted', [
            'original' => $original,
            'cleaned' => $cleaned,
            'country_code' => $countryCode,
            'number' => $number
        ]);

        return [
            'number' => $number,
            'country_code' => $countryCode
        ];
    }
}
