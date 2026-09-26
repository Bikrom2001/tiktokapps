<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/user", function(){
    return view('user');
});


Route::get("/contact", function(){
    return view('contact');
});