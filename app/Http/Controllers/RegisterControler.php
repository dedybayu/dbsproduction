<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Str;

class RegisterControler extends Controller
{
    //
    public function index(){
        return view('register', ['title' => 'Register']);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' =>'required|max:255',
            'username' => ['required', 'min:4', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
        $validatedData['bio'] = null;
        $validatedData['remember_token'] = Str::random(10);
        $validatedData['email_verified_at'] = now();


        User::create($validatedData);

        // $request->session()->flash('success-register', 'Registration successfull! Please login');

        return redirect('/login')->with('success-register', 'Registration successfull! Please login');
    }
}
