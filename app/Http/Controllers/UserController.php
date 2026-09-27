<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser(){
        $user =[
        'name' => 'Bikrom Roy',
        'email' => 'bikromroy2001@gmail.com'
    ];

        return view('user', compact('user'));
    }
}
