<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('setting.index');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPassword()
    {
        return view('setting.edit_password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!(Hash::check($request->get('current_password'), $user->password))) {
            flash()->error(__('Current password wrong.'));

            return redirect()->route('settings.edit_password');
        }

        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        flash()->success(__('New password saved.'));

        return redirect()->route('settings.index');
    }
}
