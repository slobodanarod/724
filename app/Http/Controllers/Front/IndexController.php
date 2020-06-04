<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index()
    {
        return view("frontend.index");
    }
    public function contact(Request $request)
    {
        $info = $request->all();
        Mail::to("724chatcom@gmail.com")->send(new ContactMail($info));
    }
}
