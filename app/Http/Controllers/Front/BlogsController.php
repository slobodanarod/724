<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{


    public function getAll()
    {
            $blogs = DB::table("blogs")->get();
            return response()->json([ 'blogs' => $blogs ], 200);
    }

    public function getOne(Request $request)
    {
        $blog = DB::table("blogs")->where("sef_link",$request->sef_link)->first();
        return response()->json(["blog" => $blog],200);
    }
}
