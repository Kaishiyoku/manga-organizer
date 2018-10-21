<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.index');
    }

    public function editPassword()
    {
        return view('setting.edit_password');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6'
        ];

        $request->validate($rules);

        if (!(Hash::check($request->get('current_password'), $user->password))) {
            flash()->error(__('setting.edit_password.current_password_wrong'));

            return redirect()->route('settings.edit_password');
        }

        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        flash()->success(__('setting.edit_password.success'));

        return redirect()->route('settings.index');
    }
}