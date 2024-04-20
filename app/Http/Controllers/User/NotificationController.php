<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $dataList = Notification::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(10);
        if($dataList->count() > 0) {
            foreach ($dataList as $key => $value) {
                $value->msg = __($value->message_tag, ['user' => ucwords($value->user->name)]);
            }
        }
        return view('pages.user.notification', ['dataList' => $dataList]);
    }
}
