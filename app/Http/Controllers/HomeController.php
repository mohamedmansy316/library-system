<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BooksBorrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    public function getHome(){
        $AllBooks = Book::where('borrowed', 0)->get();
        return view('index', compact('AllBooks'));
    }
}
