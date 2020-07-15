<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $blogs = DB::table("blogs")->get();

        return view("backend.blogs.index", compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        return view("backend.blogs.create");
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

        if ($request->file)
        {
            $imageName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('images/blogs'), $imageName);
        }
        else
        {
            $imageName = "no-image.png";
        }
        $insert = DB::table("blogs")->insertGetId(["created_at" => Carbon::now(), "title" => $request->title, "sef_link" => Str::slug($request->title), "description" => $request->description, "keywords" => $request->keywords, "content" => $request->content, "image" => $imageName]);
        if ($insert)
        {
            return redirect()->route("blogs.index")->with("message_type", "success")->with("message", "Başarıyla kaydedildi");
        }
        else
        {
            return redirect()->back()->with("message_type", "danger")->with("message", "Bir sorun oluştu.")->withInput();
        }

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
        $blog = DB::table("blogs")->where("id", $id)->first();

        return view("backend.blogs.edit", compact("blog"));
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

        if ($request->file)
        {
            $old_values = DB::table("blogs")->where("id", $id)->first();

            $old_image = "images/blogs/" . $old_values->image;

            if (file_exists($old_image))
            {
                unlink($old_image);
            }
            $imageName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('images/blogs'), $imageName);

            DB::table("blogs")->where("id", $id)->update(["image" => $imageName]);
        }
        $update = DB::table("blogs")->where("id", $id)->update(["updated_at" => Carbon::now(), "title" => $request->title, "sef_link" => Str::slug($request->title), "description" => $request->description, "keywords" => $request->keywords, "content" => $request->content]);
        if ($update)
        {
            return redirect()->back()->with("message_type", "success")->with("message", "Başarıyla kaydedildi");
        }
        else
        {
            return redirect()->back()->with("message_type", "danger")->with("message", "Bir sorun oluştu.");
        }

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
        $old_values = DB::table("blogs")->where("id", $id)->first();

        $old_image = "images/blogs/" . $old_values->image;

        if (file_exists($old_image))
        {
            unlink($old_image);
        }

        $deleteBlog = DB::table("blogs")->where("id", $id)->delete();
        if ($deleteBlog)
        {
            return redirect()->back()->with("message_type", "success")->with("message", "Başarıyla silindi");
        }
        else
        {
            return redirect()->back()->with("message_type", "danger")->with("message", "Bir sorun oluştu.");

        }
    }
}
