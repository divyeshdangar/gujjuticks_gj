<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use TCPDF;
use TCPDF_FONTS;

class ResumeBuilderController extends Controller
{
    public function generate(Request $request, $token)
    {
        $dataDetail = Resume::where("token", $token)->first();
        if ($dataDetail) {
            $html = View::make('pdf.resume.starter', ["dataDetail" => $dataDetail])->render();
            $pdf = new TCPDF();

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->SetCreator('GujjuTicks Resume Builder');
            $pdf->SetTitle('Divyesh Dangar Resume');
            $pdf->SetAuthor('GujjuTicks');

            $pdf->SetMargins(10, 10, 10, 10);
            $pdf->SetAutoPageBreak(true, 10);

            $pdf->AddPage();

            TCPDF_FONTS::addTTFfont(public_path('fonts/Oswald/Oswald-Bold.ttf'), 'TrueTypeUnicode', '', 96);
            TCPDF_FONTS::addTTFfont(public_path('fonts/Oswald/Oswald-Light.ttf'), 'TrueTypeUnicode', '', 96);
            TCPDF_FONTS::addTTFfont(public_path('fonts/FontAwesome/FaBold.ttf'), 'TrueTypeUnicode', '', 96);
            TCPDF_FONTS::addTTFfont(public_path('fonts/DMSans-Regular.ttf'), 'TrueTypeUnicode', '', 96);
            TCPDF_FONTS::addTTFfont(public_path('fonts/DMSans-Black.ttf'), 'TrueTypeUnicode', '', 96);

            // ✅ Dynamically register the font
            $fontPath = public_path('fonts/Oswald/Oswald-Regular.ttf');
            $fontName = TCPDF_FONTS::addTTFfont($fontPath, 'TrueTypeUnicode', '', 96);
            $pdf->SetFont($fontName, '', 14);

            $pdf->writeHTML($html, true, false, true, false, '');

            // 5. Output to browser (inline). Use 'D' to force download.
            $pdf->Output('Name_Surname_Resume.pdf', 'I');

            //return view('pdf.resume.starter', []);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('pages.resume.list')->with($message);
        }
    }
}
