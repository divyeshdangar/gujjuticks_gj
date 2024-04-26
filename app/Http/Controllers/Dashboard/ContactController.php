<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $dataList = ContactUs::orderBy('id', 'DESC')->paginate(2)->withQueryString();
        if($dataList->count() > 0) {
            // foreach ($dataList as $key => $value) {
            //     $value->msg = __($value->message_tag, ['user' => ucwords($value->user->name)]);
            // }
        }

        return view('dashboard.contact.index', ['dataList' => $dataList]);
    }

}
