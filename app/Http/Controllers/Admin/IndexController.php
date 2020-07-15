<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        return view("backend/index");
    }

    public function login()
    {
        return view("backend.login");
    }

    public function login_post(Request $request)
    {

        $control = DB::table("users")->where("email", $request->email)->where("admin", 1)->first();
        if ($control) {
            if (Auth::guard("admin")->attempt(["email" => $request->email, "password" => $request->password], 1)) {
                return redirect(route("admin.index"))->with("message", "Giriş Yapıldı.")->with("message_type", "success");
            } else {
                return back()->with("message", "Şifreniz yanlış.")->with("message_type", "danger");
            }
        } else {
            return back()->with("message", "Böyle bir kullanıcı yok.")->with("message_type", "danger");
        }
    }

    public function logout()
    {
        Auth::guard("admin")->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect(route("admin.login"));
    }

}
