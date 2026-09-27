<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser(){
        $users =[
        'name' => 'Bikrom Roy',
        'email' => 'bikromroy2001@gmail.com'
    ];

        return view('user', compact('users'));
    }
}
