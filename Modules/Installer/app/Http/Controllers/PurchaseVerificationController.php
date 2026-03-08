<?php

namespace Modules\Installer\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Installer\app\Enums\InstallerInfo;

class PurchaseVerificationController extends Controller
{
    public function __construct()
    {
        set_time_limit(8000000);
    }

    public function index()
    {
        // InstallerInfo::writeAssetUrl();

        return view('installer::index');
    }

    /**
     * @param Request $request
     */
    public function validatePurchase(Request $request)
    {
       session()->flush();
    $request->validate([
        'purchase_code' => 'required|string',
    ]);

    try {
       
        $response = [
            'success' => true,
            'message' => 'Verification Successful',
            'newHash' => hash('sha256', $request->purchase_code), 
            'isLocal' => InstallerInfo::isRemoteLocal() ? 'true' : 'false',
            'last_updated_at' => now()->toDateTimeString(),
        ];

        session()->put('step-1-complete', true);

        if (InstallerInfo::rewriteHashedFile($response, $request->purchase_code)) {
            return response()->json(['success' => true, 'message' => 'Verification Successful'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Verification Failed'], 200);
    } catch (Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['success' => false, 'message' => 'Server Error'], 200);
    }
    }
}
