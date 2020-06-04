<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function init (Request $request)
    {
        $profile = DB::table("users")->where("slug", $request->slug)->first();

        if ($profile)
        {

            if ($profile->id <> auth()->id())
            {
                if (auth()->id())
                {
                    DB::table("viewer")->insert(["user_id" => auth()->id(), "profile_id" => $profile->id, "created_at" => Carbon::now()]);
                    $smileC = DB::table("smiles")->where("user_id", auth()->id())->where("profile_id", $profile->id)->first();
                    if ($smileC)
                    {
                        $smile = true;
                    }
                    else
                    {
                        $smile = false;
                    }
                }else{
                    $smile = false;
                }
            }
            else
            {
                $smile = false;
            }

            $viewers = DB::table("viewer")->leftJoin("users", "users.id", "=", "viewer.user_id")->selectRaw("viewer.created_at as olusturulma_tarihi,users.*")->where("viewer.profile_id", $profile->id)->groupBy("viewer.user_id")->orderByDesc("viewer.id")->limit(12)->get();

            return response()->json(['profile' => $profile, "viewers" => $viewers, "smile" => $smile], 200);
        }
        else
        {
            return response()->json("Böyle bir kullanıcı yok..", 401);
        }
    }

    public function smile (Request $request)
    {
        $control = DB::table("smiles")->where("user_id", auth()->id())->where("profile_id", $request->profile_id)->first();

        if ($control)
        {
            DB::table("smiles")->where("id", $control->id)->delete();
        }
        else
        {
            DB::table("smiles")->insert(["user_id" => auth()->id(), "profile_id" => $request->profile_id, "created_at" => Carbon::now()]);
        }

        return response()->json("başarılı", 200);
    }

}
