<?php

namespace App\Http\Controllers;

use App\Models\BooksBorrow;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getProfile(){
        /**
         * Register a binding with the container.
         *
         * @param  string|array  $abstract
         * @param  \Closure|string|null  $concrete
         * @param  bool  $shared
         * @return void
         *
         * @throws \Exception
         */
        return view('profile');
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('home')->withSuccess('You have successfully logged out');
    }


}
