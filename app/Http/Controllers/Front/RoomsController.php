<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    public function roomsApi (Request $request)
    {
        $rooms  = DB::table("chatrooms")->where("room_status", 1)->get();
        $counts = [];
        foreach ($rooms as $k)
        {
            $firstValue = DB::table("chat_messages")->where("room_id", $k->id)->get();
            $count      = count($firstValue);
            array_push($counts, ["id" => $k->id, "count" => $count]);
        }

        return response()->json(["rooms" => $rooms, "counts" => $counts], 200);
    }

    public function init (Request $request)
    {
        $room = DB::table("chatrooms")->where("room_slug", $request->slug)->first();
        if ($room)
        {
            $messages = DB::table("users")->join("chat_messages", "chat_messages.user_id", "=", "users.id")->where("chat_messages.room_id", $room->id)->get();
            $users = DB::table("chat_users")->leftJoin("users", "users.id", "=", "chat_users.user_id")->where("chat_users.room_id", "=", $room->id)->distinct("chat_users.user_id")->get();
            //log
            DB::table("posts")->insert(["type_id" => $room->id, "user_id" => auth()->id(), "type" => 2, "post_content" => " odasına giriş yaptı.", "created_at" => Carbon::now()]);
            $firstValue = DB::table("chat_messages")->where("room_id", $room->id)->get();
            $count      = count($firstValue);

            return response()->json(['room' => $room, 'messages' => $messages, 'users' => $users, "count" => $count], 200);
        }
        else
        {
            return response()->json("Artık böyle bir oda yok.", 401);
        }
    }

    public function login (Request $request)
    {
        DB::table("chat_users")->where("user_id", auth()->id())->delete();
        DB::table("chat_users")->insert(["user_id" => auth()->id(), "room_id" => $request->room_id]);

        return response()->json("başarılı", 200);
    }

    public function leave (Request $request)
    {
        DB::table("chat_users")->where("user_id", auth()->id())->delete();
    }

    public function sendMessage (Request $request)
    {
        $insert = DB::table("chat_messages")->insert(["user_id" => auth()->id(), "room_id" => $request->room_id, "message" => $request->text, "created_at" => Carbon::now()]);

        if ($insert)
        {
            return response()->json(Carbon::now(), 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 401);
        }
    }

    public function allMessages (Request $request)
    {
        $messages = DB::table("users")->join("chat_messages", "chat_messages.user_id", "=", "users.id")->where("chat_messages.room_id", $request->room_id)->get();

        return response()->json($messages, 200);
    }


}
