<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BooksBorrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function getHome()
    {
        $AllBooks = Book::where('borrowed', 0)->get();
        if (Auth::check()) {
            $AllBorowedBooks = BooksBorrow::where('user_id', Auth::user()->id )->get();
            return view('index', compact('AllBooks', 'AllBorowedBooks'));
        }
            return view('index', compact('AllBooks'));
    }
}
