<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QrCode as QrCodeModel;
use Storage;

class QrCodeController extends Controller
{
    public function generateQrCodes()
    {
        $numCodes = 10;

        for ($i = 0; $i < $numCodes; $i++) {
            $codeData = uniqid();
            $image = QrCode::format('png')
                 ->size(500)->errorCorrection('H')
                 ->generate('http://127.0.0.1:8000/scan-qr-code/'.$codeData.'');
            $output_file = 'qrcodes/img-' . $codeData . '.png';
            Storage::disk('local')->put($output_file, $image);

            QrCodeModel::create([
                'code_data' => $codeData
            ]);
        }

        return 'QR codes generated successfully.';
    }

    public function show()
    {
        $image = QrCode::format('png')
                 ->size(200)->errorCorrection('H')
                 ->generate('A simple example of QR code!');
        $output_file = 'qrcodes/img-' . time() . '.png';
        Storage::disk('local')->put($output_file, $image);

        return true;
    }

    public function scan()
    {
        return view('scan');
    }
}
