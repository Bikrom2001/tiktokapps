<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/user", function(){

    $user =[
        'name' => 'Bikrom Roy',
        'email' => 'bikromroy2001@gmail.com'
    ];

    return view('user', compact('user'));
});


Route::get("/contact", function(){
    return view('contact');
});