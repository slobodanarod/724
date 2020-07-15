<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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

    public function last_users(Request $request)
    {
        $users = DB::table("users")->orderByDesc("id")->paginate(20);
        return response()->json($users,200);
    }

    public function countries()
    {
        $countries = DB::table("countries_list")->get();
        return response()->json($countries,200);
    }
    public function page(Request $request)
    {
        $page = DB::table("pages")->where("id",$request->page_id)->first();
        return response()->json($page,200);
    }
}
