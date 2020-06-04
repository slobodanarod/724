<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MessagesController extends Controller
{
    public function sendMessage (Request $request)
    {

        $control  = DB::table("conversations")->where("user_id", Auth::id())->where("profile_id", $request->p_id)->orderByDesc("id")->first();
        $control1 = DB::table("conversations")->where("user_id", $request->p_id)->where("profile_id", Auth::id())->orderByDesc("id")->first();

        if ($control || $control1)
        {
            if ($control1)
            {
                $id = $control1->id;
            }
            elseif ($control)
            {
                $id = $control->id;

            }
            $insertMessage = DB::table("conversations_msg")->insert(["message" => $request->message, "created_at" => Carbon::now(), "user_id" => Auth::id(), "c_id" => $id, "status" => 0, "delete" => "", "view" => 0]);
        }
        else
        {
            $insertWithKey = DB::table("conversations")->insertGetId(["user_id" => Auth::id(), "profile_id" => $request->p_id, "created_at" => Carbon::now()]);
            $insertMessage = DB::table("conversations_msg")->insert(["message" => $request->message, "user_id" => Auth::id(), "c_id" => $insertWithKey, "created_at" => Carbon::now(), "status" => 0, "delete" => "", "view" => 0]);
        }

        if ($insertMessage)
        {
            return response()->json("Mesaj Gönderildi", 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 401);
        }


    }

    public function allconvs (Request $request)
    {
        $all = DB::table("conversations")->orWhere("user_id", Auth::id())->orWhere("profile_id", Auth::id())->orderByDesc("id")->get();

        $arr = [];
        foreach ($all as $conv)
        {
            if ($conv->user_id == Auth::id())
            {
                $profile  = DB::table("users")->where("id", $conv->profile_id)->first();
                $last_msg = DB::table("conversations_msg")->select("message", "created_at")->where("c_id", $conv->id)->orderByDesc("id")->first();
            }
            elseif ($conv->profile_id == Auth::id())
            {
                $profile  = DB::table("users")->where("id", $conv->user_id)->first();
                $last_msg = DB::table("conversations_msg")->select("message", "created_at")->where("c_id", $conv->id)->orderByDesc("id")->first();
            }
            $conv->profile  = $profile;
            $conv->last_msg = $last_msg;
            array_push($arr, $conv);
        }

        if (count($arr) > 0)
        {
            return response()->json($arr, 200);
        }
        else
        {
            return response()->json("Mesaj yok", 401);
        }

    }

    public function getConversation (Request $request)
    {
        $all = DB::table("conversations")->where("id", $request->id)->first();

        if ($all->user_id == Auth::id())
        {
            $profile = DB::table("users")->where("id", $all->profile_id)->first();
        }
        elseif ($all->profile_id == Auth::id())
        {
            $profile = DB::table("users")->where("id", $all->user_id)->first();
        }

        $conversations = DB::table("conversations_msg")->where("c_id", $request->id)->limit(50)->get();

        return response()->json(["conversation" => $conversations, "profile" => $profile], 200);
    }

    public function sendinChat (Request $request)
    {
        $insertMessage = DB::table("conversations_msg")->insertGetId(["message" => $request->message, "user_id" => Auth::id(), "c_id" => $request->c_id, "created_at" => Carbon::now(), "status" => 0, "delete" => "", "view" => 0]);
        if ($insertMessage)
        {
            $data = DB::table("conversations_msg")->where("id", $insertMessage)->first();

            return response()->json($data, 200);
        }
        else
        {
            return response()->json("Hata", 401);

        }
    }
}
