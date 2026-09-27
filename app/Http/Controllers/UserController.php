<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUser(){
        $users =[
        [
        'id' => '1',
        'name' => 'Bikrom Roy',
        'email' => 'bikromroy2001@gmail.com'
        ],
         [
        'id' => '2',
        'name' => 'Hafizur Rahaman',
        'email' => 'hafizur@gmail.com'
        ]
    ];

        return view('user', compact('users'));
    }
}
