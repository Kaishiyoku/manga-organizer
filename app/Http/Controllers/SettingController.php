<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting.index');
    }
}