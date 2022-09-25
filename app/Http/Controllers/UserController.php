<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    public function getAdmin(){
        return view('admin.index');
    }
    public function getProfile(){
        return view('profile');
    }
    public function logout(){
        if (auth()->check()) {
            Auth::logout();
            return redirect()->route('home')->withSuccess('You have successfully logged out');
        } else {
            return redirect()->route('home')->withSuccess('You are already logged out');
        }
    }


}
