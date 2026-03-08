<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Installer\app\Enums\InstallerInfo;
use Modules\Installer\app\Models\Configuration;

if (! function_exists('setup_complete_status')) {
    function setupStatus()
    {
        $cacheKey = 'setup_complete_status';
        if (! Cache::has($cacheKey)) {
            try {
                Cache::rememberForever($cacheKey, function () {
                    return Configuration::where('config', 'setup_complete')->first()?->value == 0 ? false : true;
                });
            } catch (Exception $e) {
                Log::error($e->getMessage());
                Cache::rememberForever($cacheKey, function () {
                    return false;
                });
            }
        }

        return Cache::get($cacheKey);
    }
}
if (! function_exists('purchaseVerificationHashed')) {
    function purchaseVerificationHashed($filepath, $isLocal = false)
    {
        if (file_exists($filepath)) {
            $licenseFile = InstallerInfo::getLicenseFileData();

            return [
                'success' => true,
                'message' => 'Verification Successful',
                'verification_hashed' => $licenseFile['verification_hashed'] ?? hash('sha256', time()),
                'isLocal' => $isLocal ? 'true' : 'false',
            ];
        }

        return false;
    }
}

if (! function_exists('changeEnvValues')) {
    function changeEnvValues($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key.'='.env($key),
            $key.'='.$value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
}