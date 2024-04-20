<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $dataDetail = User::find(Auth::id());
        if($dataDetail) {
            return view('pages.user.profile', ['dataDetail' => $dataDetail]);            
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|digits:10',
            'bio' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('user/profile/edit')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        dd($validated);
        die;

        return to_route('post.show', ['post' => '']);
    }
}
