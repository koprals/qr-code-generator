<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode as QrCodeModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException as Th;

class QrCodeScanController extends Controller
{
    public function scanQrCode($code)
    {
        // dd($code);
        $qrCode = QrCodeModel::where('code_data', $code)->first();

        if ($qrCode && !$qrCode->is_scanned) {
            // Update the QR code as scanned
            $updateData = DB::table('qr_codes')
              ->where('id', $qrCode->id)
              ->update(['is_scanned' => '1']);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid or already scanned QR code.']);
    }
}
