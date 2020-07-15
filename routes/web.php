<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::group(["namespace" => "Admin"], function () {

    Route::get('/admin/login', "IndexController@login")->name("admin.login");
    Route::post('/admin/login', "IndexController@login_post")->name("admin.login.post");

    Route::group(["middleware" => "admin"],function ()
    {
        Route::get('/admin/logout', "IndexController@logout")->name("admin.logout");
        Route::get('/admin/', "IndexController@index")->name("admin.index");
        Route::get('/admin/users/with/abouts', "UsersController@wAbout")->name("admin.wAbout");
        Route::get('/admin/users/with/img', "UsersController@wImg")->name("admin.wImg");
        Route::get('/admin/users/with/ban', "UsersController@wBan")->name("admin.wBan");
        Route::get('/admin/users/with/danger', "UsersController@wDanger")->name("admin.wDanger");
        Route::get('/admin/users/banned/{id}', "UsersController@banned")->name("admin.users.banned");
        Route::get('/admin/users/with/fake', "UsersController@fake")->name("admin.users.fake");
        Route::get('/admin/users/run', "UsersController@run")->name("admin.users.run");

        Route::resources([
            '/admin/users' => 'UsersController',
            '/admin/blogs' => 'BlogsController',
            '/admin/pages' => 'PagesController',
            '/admin/settings' => 'SettingsController',
            'posts' => 'PostController'
        ]);
    });


});

Route::post("/user/init", "Front\UserController@init");
Route::get("/user/control", function () {

    if (auth()->check()) {
        echo "tamam";
        echo auth()->id();
    } else {
        echo "değil";
    }

});
Route::post("/user/register", "Front\UserController@register");
Route::post("/user/login", "Front\UserController@login");
Route::post("/user/settings/update", "Front\UserController@update");
Route::post("/user/imageUpload", "Front\UserController@imageUpload");
Route::post("/ch/password", "Front\UserController@chpassword");
Route::get("/user/logout", "Front\UserController@logout");
Route::get("/countries", "Front\IndexController@countries");

Route::post("/chat/rooms/get", "Front\RoomsController@roomsApi");
Route::post("/chat/room/init", "Front\RoomsController@init");
Route::post("/chat/room/login", "Front\RoomsController@login");
Route::post("/chat/room/leave", "Front\RoomsController@leave");
Route::post("/chat/room/message", "Front\RoomsController@sendMessage");
Route::post("/chat/room/messages", "Front\RoomsController@allMessages");

Route::post("/profile/init", "Front\ProfileController@init");
Route::post("/profile/smile", "Front\ProfileController@smile");

Route::post("/profile/message", "Front\MessagesController@sendMessage");
Route::post("/messages/all", "Front\MessagesController@allconvs");
Route::post("/message/send", "Front\MessagesController@sendinChat");
Route::post("/get/conv", "Front\MessagesController@getConversation");

Route::post("/log", "Front\UserController@log");
Route::post("/actions/viewer/in", "Front\ActionsController@viewerin");
Route::post("/actions/viewer/out", "Front\ActionsController@viewerout");
Route::post("/actions/smiles/in", "Front\ActionsController@smilesin");
Route::post("/actions/smiles/out", "Front\ActionsController@smilesout");
Route::post("/post/send", "Front\UserController@post");
Route::post("/get/last-users", "Front\IndexController@last_users");
Route::post("/post/get", "Front\UserController@posts");
Route::post("/contact/message", "Front\IndexController@contact");
Route::post("/get/page", "Front\IndexController@page");

Route::get("/get/blogs", "Front\BlogsController@getAll");
Route::post("/get/blog", "Front\BlogsController@getOne");

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');

    return "Cache is cleared";
});


Route::get('/test/mail', function () {
    return new \App\Mail\UserRegister();
});

Route::get('/{any}', function () {
    return view('frontend.layout');
})->where("any", ".*");
