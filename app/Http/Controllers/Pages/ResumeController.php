<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    public function index(Request $request): View
    {
        $metaData = [
            "title" => "Free Online Resume Builder | Create a Professional Resume in Minutes | GujjuTicks Resume Builder",
            "description" => "Build a job-winning resume online with our free, easy-to-use resume builder. Choose a template, fill in your details, and download a professional PDF resume—no sign-up required.",
            //"image" => "",
            "keywords" => "online resume builder, free resume maker, create resume, resume templates, resume generator, download resume pdf, resume builder india, build cv online, professional resume",
            "url" => route('pages.resume.list')
        ];
        return view('pages.resume.list', ['metaData' => $metaData]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'firstname' => 'required|max:128',
            'lastname' => 'required|max:128',
            'email' => 'required|max:128|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.resume.list')->withErrors($validator)->withInput();
        } 

        $dataToInsert = $validator->validated();
        $data = [
            "email" => $dataToInsert['email'],
        ];
    }

    public function start(Request $request): View
    {

        echo "123 456 789";

        die;
        $metaData = [
            "title" => "Free Online Resume Builder | Create a Professional Resume in Minutes | GujjuTicks Resume Builder",
            "description" => "Build a job-winning resume online with our free, easy-to-use resume builder. Choose a template, fill in your details, and download a professional PDF resume—no sign-up required.",
            //"image" => "",
            "keywords" => "online resume builder, free resume maker, create resume, resume templates, resume generator, download resume pdf, resume builder india, build cv online, professional resume",
            "url" => route('pages.resume.list')
        ];
        return view('pages.resume.start', ['metaData' => $metaData, 'categories' => $categories, 'dataList' => $dataList]);
    }
}
