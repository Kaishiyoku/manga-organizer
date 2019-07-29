<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * @var array
     */
    private $validationRules = [
        'g-recaptcha-response' => 'required|captcha',
        'email' => 'required|email',
        'fullname' => 'required',
        'content' => 'required'
    ];

    /**
     * Show contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showContactForm()
    {
        return view('home.contact');
    }

    /**
     * Send the contact form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendContactForm(Request $request)
    {
        $data = $request->validate($this->validationRules);

        Mail::to(env('APP_ADMIN_EMAIL'))->send(new ContactFormSent($data['email'], $data['fullname'], $data['content']));

        flash()->success(trans('home.contact.success'));

        return redirect('/');
    }

    public function toggleAsText()
    {
        session()->put('is_as_text', !session()->get('is_as_text') ?? true);

        return redirect()->back();
    }
}
