<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view('user.profile', ['title' => 'Profile']);
        
    }

    public function viewEditUser(){
        return view('user.edit-profile', ['title' => 'Edit Profile']);
        
    }
}
