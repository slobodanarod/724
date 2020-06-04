<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActionsController extends Controller
{
    public function viewerin (Request $request)
    {
        $viewers = DB::table("viewer")->leftJoin("users","users.id","=","viewer.user_id")->selectRaw("viewer.created_at as olusturulma_tarihi,users.*")->where("viewer.profile_id", auth()->id())->orderByDesc("viewer.id")->paginate(12);
        if ($viewers)
        {
            return response()->json($viewers, 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 500);
        }
    }

    public function viewerout (Request $request)
    {
        $viewers = DB::table("viewer")->leftJoin("users","users.id","=","viewer.profile_id")->selectRaw("viewer.created_at as olusturulma_tarihi,users.*")->where("viewer.user_id", auth()->id())->orderByDesc("viewer.id")->paginate(12);
        if ($viewers)
        {
            return response()->json($viewers, 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 500);
        }
    }

    public function smilesin (Request $request)
    {
        $viewers = DB::table("smiles")->leftJoin("users","users.id","=","smiles.user_id")->selectRaw("smiles.created_at as olusturulma_tarihi,users.*")->where("smiles.profile_id", auth()->id())->orderByDesc("smiles.id")->paginate(12);
        if ($viewers)
        {
            return response()->json($viewers, 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 500);
        }
    }

    public function smilesout (Request $request)
    {
        $viewers = DB::table("smiles")->leftJoin("users","users.id","=","smiles.profile_id")->selectRaw("smiles.created_at as olusturulma_tarihi,users.*")->where("smiles.user_id", auth()->id())->orderByDesc("smiles.id")->paginate(12);
        if ($viewers)
        {
            return response()->json($viewers, 200);
        }
        else
        {
            return response()->json("Hata oluştu.", 500);
        }
    }

}
