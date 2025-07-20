<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use TCPDF;
use TCPDF_FONTS;

class ResumeBuilderController extends Controller
{
    public function generate(Request $request)
    {
        //$html = view('pdf.resume.starter')->render();

        $data = [
            'title' => 'TCPDF + Blade Example',
            'name' => 'Gujju Ticks'
        ];

        $html = View::make('pdf.resume.starter', $data)->render();
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
    }
}
