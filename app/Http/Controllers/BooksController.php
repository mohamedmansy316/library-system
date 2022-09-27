<?php

namespace App\Http\Controllers;
//Models
use App\Models\Book;
use App\Models\BooksBorrow;
//Laravel Packages
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
//Composer Packages
use Image as ImageLib;

class BooksController extends Controller{

    public function getBookBorrow($id){
        $TheBook = Book::findOrFail($id);
        if($TheBook->borrowed == 1){
            return back()->withErrors('Book not avaiable now');
        }
        if(auth()->user()->hasRequestedBook($id)){
            return redirect()->route('home')->withErrors('You have already sent a borrowing request');
        }
        BooksBorrow::create([
            'book_id' => $TheBook->id,
            'user_id' =>  auth()->user()->id ,
        ]);
        return redirect()->route('home')->withSuccess('Borrow request sent successfully');
    }
    public function getCancelOrder($id){
        $TheRequest = BooksBorrow::findOrFail($id);
        $TheRequest->update([
            'status' =>  'canceled' ,
        ]);
        return redirect()->route('home')->withSuccess('Cancel request sent successfully');
    }
}
