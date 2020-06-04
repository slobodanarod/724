<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ProfileView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $users = User::where("role", "<>", 2)->orderByDesc("id")->paginate(20);

        return view("backend.users.index", compact("users"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        $user = User::where("id", $id)->orderByDesc("id")->firstOrFail();

        return view("backend.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        //
    }


    public function wAbout ()
    {
        $users = User::where("role", "<>", 2)->where("description", "<>", null)->orderByDesc("id")->paginate(20);

        return view("backend.users.wAbout", compact("users"));
    }

    public function wImg ()
    {
        $users = User::where("role", "<>", 2)->where("image", "NOT LIKE", '%man%')->orderByDesc("id")->paginate(20);

        return view("backend.users.wImg", compact("users"));
    }

    public function wBan ()
    {
        $users = User::where("role", "<>", 2)->where("status", 0)->orderByDesc("id")->paginate(20);

        return view("backend.users.bans", compact("users"));
    }

    public function wDanger ()
    {
        $all = ["sik", "yarak", "sikiş", "sikici", "536", "amyalar", "amcı", "545", "533", "531", "506", "543", "aktif", "pasif", "götçü", "göt"];

        $users = DB::Table('users')->orWhere(function($query) use ($all) {
                for ($i = 0; $i < count($all); $i++)
                {
                    $query->orwhere('name', 'like', '%' . $all[ $i ] . '%');
                }
            })->orWhere(function($query) use ($all) {
                for ($i = 0; $i < count($all); $i++)
                {
                    $query->orwhere('description', 'like', '%' . $all[ $i ] . '%');
                }
            })->orderByDesc("id")->paginate(20);


        return view("backend.users.wDanger", compact("users"));
    }

    public function banned ($id)
    {
        $user = User::where("id", $id)->orderByDesc("id")->firstOrFail();

        if ($user->status == 1)
        {
            DB::table("users")->where("id", $id)->update(["status" => 0]);
        }
        else
        {
            DB::table("users")->where("id", $id)->update(["status" => 1]);
        }

        return redirect()->back();

    }

    public function fake ()
    {
        $users = User::where("fake", "=", 1)->orderByDesc("id")->paginate(20);

        return view("backend.users.fake", compact("users"));
    }

    public function run ()
    {
        $users = User::where("fake", "=", 1)->orderByDesc("id")->get();
        foreach ($users as $user)
        {
            $profiles = DB::table("users")->select("id","email")->where("gender", 1)->get();
            $count = count($profiles);
//            dd($profiles);
            $arr = [];
            for($i = 0; $i<$count; $i++ )
            {
                array_push($arr,["id" => $profiles[$i]->id, "email" => $profiles[$i]->email]);
            }

            for($i = 0; $i<20; $i++ )
            {
                $id = array_rand($arr, 1);
                DB::table("viewer")->insert( ["user_id" => $user[ "id" ], "profile_id" => $arr[$id]["id"], "created_at" => Carbon::now() ] );
                Mail::to($arr[$id]["email"])->send(new ProfileView($user));
            }
        }

    }

}
