<?php

namespace App\Http\Controllers;

use App\Models\BooksBorrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAdmin(){
        return view('admin.index');
    }
    public function getProfile(){
        if (auth()->check()) {
            $TheUser = User::findOrFail(Auth::user()->id);
            $Orders = BooksBorrow::where('user_id', $TheUser->id)->get();
            return view('profile', compact('Orders'));
        } else {
            return redirect()->route('home')->withErrors('Login first to see your requests');
        }
        return view('profile');
    }
    public function getOrders(){
        if (auth()->check()) {
            $TheUser = Auth::user()->id;
            dd($TheUser);
        } else {
            return redirect()->route('home')->withErrors('Login first to see your requests');
        }
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
