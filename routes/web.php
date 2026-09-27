<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/user", [UserController::class, 'showUser']);


Route::get("/contact", function(){
    return view('contact');
});