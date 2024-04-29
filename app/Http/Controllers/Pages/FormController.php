<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\ContactUs;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FormController extends Controller
{
    public function show(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "Get in Touch: Contact GujjuTicks",
            "description" => "Reach out to GujjuTicks easily with our contact form or contact information. Whether you have questions, feedback, or inquiries, we're here to assist you promptly. Connect with us now!",
            //"image" => "",
            "url" => route('form.contact')
        ];

        return view('pages.form.contact', ['metaData' => $metaData]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|digits:10',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('contact-us')->withErrors($validator)->withInput();
        }    
        $dataToInsert = $validator->validated();
        $dataDetail = new ContactUs;
        $dataDetail->message = Auth::id();
        $dataDetail->message = $dataToInsert['message'];
        $dataDetail->phone = $dataToInsert['phone'];
        $dataDetail->email = $dataToInsert['email'];
        $dataDetail->name = $dataToInsert['name'];
        $dataDetail->save();

        $message = [
            "message" => [
                "type" => "success",
                "title" => __('dashboard.great'),
                "description" => __('dashboard.details_submitted')
            ]
        ];
        return redirect()->route('home')->with($message);
    }

}
