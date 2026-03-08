<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GlobalMailTrait;
use App\Helpers\MailHelper;
use App\Services\MessageCentralService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class OTPController extends Controller
{
    use GlobalMailTrait;

    protected $messageCentralService;

    public function __construct(MessageCentralService $messageCentralService)
    {
        $this->messageCentralService = $messageCentralService;
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'contact' => 'required',
            'type' => 'required|in:email,phone'
        ]);

        $contact = $request->contact;
        $type = $request->type;
        $otp = rand(100000, 999999);

        // Store in session
        Session::put('quote_otp', $otp);
        Session::put('quote_otp_contact', $contact);
        Session::put('quote_otp_type', $type);
        Session::put('quote_otp_expires_at', now()->addMinutes(10));

        if ($type === 'email') {
            // Send email
            MailHelper::setMailConfig();
            $subject = "Verification Code for Your Quote Request";
            $message = "Your verification code is: " . $otp . ". This code will expire in 10 minutes.";

            $this->sendMail($contact, $subject, $message);
        } else {
            // Send SMS via Message Central
            try {
                // Format phone number and extract country code
                $phoneData = $this->messageCentralService->formatPhoneNumber($contact);

                // Message Central generates OTP automatically, but we still generate one for session storage
                // The OTP parameter is optional - Message Central will generate its own

                $result = $this->messageCentralService->sendOTP(
                    $phoneData['number'],
                    $phoneData['country_code'],
                    $otp  // Optional - Message Central generates its own OTP
                );

                if (!$result['success']) {
                    // Log detailed error information
                    Log::error("Message Central SMS Error", [
                        'message' => $result['message'],
                        'error_type' => $result['error_type'] ?? null,
                        'response_code' => $result['response_code'] ?? null,
                        'http_status' => $result['http_status'] ?? null,
                        'error_data' => $result['error'] ?? null,
                        'debug_info' => $result['debug_info'] ?? null
                    ]);

                    // Provide user-friendly error message
                    $errorMessage = $result['message'] ?? 'Failed to send OTP';

                    // Use the specific error message from MessageCentralService
                    // It already provides detailed messages for different error types:
                    // - balance: insufficient credits
                    // - subscription: SMS subscription not active
                    // - pricing: pricing not configured
                    // - authentication: token expired/invalid
                    // No need to override here as MessageCentralService handles it

                    // In development, include more details
                    $responseData = [
                        'status' => 'error',
                        'message' => $errorMessage
                    ];

                    // Add debug info in development mode
                    if (config('app.debug')) {
                        $responseData['debug'] = [
                            'error_type' => $result['error_type'] ?? null,
                            'response_code' => $result['response_code'] ?? null,
                            'http_status' => $result['http_status'] ?? null,
                            'raw_error' => $result['error'] ?? null
                        ];
                    }

                    return response()->json($responseData, 500);
                }

                // Store verification ID if available
                if (isset($result['verification_id'])) {
                    Session::put('quote_otp_verification_id', $result['verification_id']);
                }
            } catch (\Exception $e) {
                Log::error("Message Central SMS Exception: " . $e->getMessage());

                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send OTP: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully'
        ]);
    }

    public function verifyOTP(Request $request)
    {
        // OTP can be 4-6 digits depending on the service
        // Clean the OTP input - remove spaces and non-numeric characters
        $cleanOtp = preg_replace('/[^\d]/', '', trim($request->otp));
        
        $request->validate([
            'otp' => 'required|string|min:4|max:6',
        ]);
        
        // Replace the OTP with cleaned version for processing
        $request->merge(['otp' => $cleanOtp]);

        $storedOtp = Session::get('quote_otp');
        $expiresAt = Session::get('quote_otp_expires_at');
        $verificationId = Session::get('quote_otp_verification_id');
        $contact = Session::get('quote_otp_contact');
        $type = Session::get('quote_otp_type');

        // If we have verification ID from Message Central, validate with their API ONLY
        if ($verificationId && $type === 'phone' && $contact) {
            try {
                $phoneData = $this->messageCentralService->formatPhoneNumber($contact);

                Log::info('Validating OTP with Message Central', [
                    'mobile' => $phoneData['number'],
                    'country_code' => $phoneData['country_code'],
                    'verification_id' => $verificationId,
                    'otp_length' => strlen($request->otp)
                ]);

                $result = $this->messageCentralService->validateOTP(
                    $phoneData['number'],
                    $phoneData['country_code'],
                    $request->otp,
                    $verificationId
                );

                if ($result['success']) {
                    // Mark as verified in session
                    Session::put('quote_otp_verified', true);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'OTP verified successfully'
                    ]);
                } else {
                    Log::error('Message Central OTP validation failed', [
                        'message' => $result['message'],
                        'mobile' => $phoneData['number']
                    ]);

                    return response()->json([
                        'status' => 'error',
                        'message' => $result['message'] ?? 'Invalid OTP code. Please check and try again.'
                    ], 400);
                }
            } catch (\Exception $e) {
                Log::error("Message Central OTP validation exception: " . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to verify OTP. Please try again or resend the code.'
                ], 400);
            }
        }

        // Fallback to session-based validation (for email OTP or when Message Central is not used)
        if (!$storedOtp || now()->gt($expiresAt)) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP expired or not found. Please resend.'
            ], 400);
        }

        // For session validation, OTP should match exactly
        if ($request->otp == $storedOtp) {
            // Mark as verified in session
            Session::put('quote_otp_verified', true);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid OTP code.'
        ], 400);
    }
}
