<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function init (Request $request)
    {


        $user = User::where("token", $request->token)->first();
        if($user)
        {
            return response()->json(["user" => $user,"status" => true], 200);
        }else{
            return response()->json(["user" => $user,"status" => false], 200);
        }

    }

    public function register (Request $request)
    {

        $validator = Validator::make($request->all(), ["name" => "required|min:5|max:50", "email" => "required|email|unique:users", "password" => "required|min:6|confirmed|max:15"]);

        if ($validator->fails())
        {
            $errors = $validator->errors();

            return response()->json($errors->first(), 400);
        }
        else
        {
            $rand = rand(1, 7);
            if ($request->gender == 1)
            {
                $image = "man-" . $rand . ".png";
            }
            else
            {
                $image = "woman-" . $rand . ".png";
            }

            function getToken($length){
                $token = "";
                $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
                $codeAlphabet.= "0123456789";
                $max = strlen($codeAlphabet);

                for ($i=0; $i < $length; $i++) {
                    $token .= $codeAlphabet[random_int(0, $max-1)];
                }

                return $token;
            }

            $slug = Str::slug($request->name);
            $token = "fdsfdsfdsfdsfs";
            $user = User::create([
                "name" => $request->name,
                "token" => getToken(30),
                "email" => $request->email,
                'gender' => $request->gender,
                'image' => $image,
                'borndate' => $request->borndate,
                'city' => $request->city,
                "slug" => $slug,
                "password" => Hash::make($request->password),
                "status" => 1]);

            Auth::attempt(['name' => $request->name, 'password' => $request->password]);

            Mail::to($request->email)->send(new UserRegister($user));

            return response()->json($user, 200);
        }

    }

    public function login (Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where("email", $request->email)->first();
            return response()->json($user, 200);
        }
        else
        {
            return response()->json("Lütfen bilgilerinizi kontrol ediniz.", 401);
        }
    }

    public function logout ()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return response()->json("çıkış yapıldış",200);
    }

    public function update (Request $request)
    {
        $user = User::where("id", auth()->id())->update(['borndate' => $request->borndate, 'city' => $request->city, 'description' => $request->description,]);

        if ($user)
        {
            return response()->json("Başarıyla güncellendi.", 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 401);
        }

    }

    public function imageUpload (Request $request)
    {
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images/users'), $imageName);
        User::where("id", Auth::id())->update(["image" => $imageName]);

        return response()->json($imageName, 200);
    }

    public function post (Request $request)
    {
        DB::table("posts")->insert(["type" => 1, "type_id" => 0, "user_id" => $request->user_id, "post_content" => $request->post_content, "created_at" => Carbon::now()]);
    }

    public function posts (Request $request)
    {
        if ($request->user_id == 0)
        {
            $posts = DB::table("posts")->leftJoin("users", "users.id", "=", "posts.user_id")->leftJoin("chatrooms", "chatrooms.id", "=", "posts.type_id")->selectRaw("posts.created_at as olusturma_tarihi, posts.*,users.name,users.image,users.slug, chatrooms.*")->orderByDesc("posts.created_at")->paginate(12);
        }
        else
        {
            $posts = DB::table("posts")->leftJoin("users", "users.id", "=", "posts.user_id")->leftJoin("chatrooms", "chatrooms.id", "=", "posts.type_id")->selectRaw("posts.created_at as olusturma_tarihi, posts.*,users.name,users.image,users.slug, chatrooms.*")->where("users.id", "=", $request->user_id)->orderByDesc("posts.created_at")->limit(12)->get();
        }

        return response()->json($posts, 200);
    }

    public function chpassword (Request $request)
    {

        $user = DB::table("users")->where('id', '=', auth()->id())->first();
        if ($user)
        {
            if (Hash::check($request->old, $user->password))
            {
                DB::table("users")->where("id", auth()->id())->update(["password" => Hash::make($request->new)]);

                return response()->json("Şifreniz başarıyla değiştirildi.", 200);
            }
            else
            {
                return response()->json($request->new, 401);
            }
        }
        else
        {
            return response()->json("Eski şifren doğru değil.", 402);

        }
    }
}
