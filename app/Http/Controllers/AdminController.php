<?php

namespace App\Http\Controllers;
//Models
use App\Models\Book;
use App\Models\BookReverse;
use App\Models\BooksBorrow;
//Laravel Packages
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
//Composer Packages
use Image as ImageLib;
class AdminController extends Controller
{
    public function getAdmin(){
        /**.
         * @return redirect to All books page
         */
        return redirect()->route('admin.books.all');
    }
    public function getAllBooks(){
        /**.
         * @return redirect to All books page
         */
        $AllBooks = Book::all();
        return view('admin.books.all', compact('AllBooks'));
    }

    public function getCreateBook(){
        /**.get books Creation page
         * @return redirect to All books page
         */
        return view('admin.books.new');
    }
    public function postCreateBook(Request $r){
        /**
         * Create a new book
         *
         * @param  array $request
         * @return all book page
         */
        $Rules = [
            'title' => 'required|min:5',
            'slug' => 'required|unique:books',
            'description' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books|numeric',
            'tags' => 'required',
            'image' => 'mimes:jpg,webp,png|max:5120', //File validation (extensions, application/type)
        ];
        $Validator = Validator::make($r->all(), $Rules);
        if($Validator->fails()){
            return redirect()->back()->withErrors($Validator->errors()->all())->withInput();
        }else{
            $BookData['slug'] = strtolower(str_replace(' ' , '-' , $r->slug)); //Use regex to clearn out special charachters and arabic chracters
            if($r->has('image')){
                $ImageName = $BookData['slug'].'.'.$r->image->getClientOriginalExtension();
                $img = ImageLib::make($r->image);
                // backup state
                $img->backup();
                // Tiny Thumb
                $img->fit(60, 60);
                $img->save('storage/app/public/books/images/small_thumb/'.$ImageName);
                $img->reset();
                // Thumb
                $img->fit(250, 250);
                $img->save('storage/app/public/books/images/thumb/'.$ImageName);
                $img->reset();
                // Full Size
                $img->fit(650, 650);
                $img->save('storage/app/public/books/images/full_size/'.$ImageName);
                $img->reset();
                $BookData['image'] = $ImageName;
            }
            Book::create($BookData);
            return redirect()->route('admin.books.all')->withSuccess('Book Created Successfully');
        }
    }
    public function getEditBook($id){
        /**
         * get edit book page
         *
         * @param integer $id (book id)
         * @return edit book page
         */
        $TheBook = Book::findOrFail($id);
        return view('admin.books.edit' , compact('TheBook'));
    }
    public function postEditBook(Request $r, $id){
        /**
         * send edit book reuest
         *
         * @param  array $request
         * @param  integer $id (book id)
         * @return all book page
         */
        $TheBook = Book::findOrFail($id);

        $Rules = [
            'title' => 'required|min:5',
            'description' => 'required',
            'author' => 'required',
            'image' => 'image|max:45000',
        ];
        $Validator = Validator::make($r->all(), $Rules);
        if($Validator->fails()){
            return redirect()->back()->withErrors($Validator->errors()->all())->withInput();
        }else{
            $BookData['slug'] = $TheBook->slug;
            $BookData['tags'] = str_replace(',' , ' ' , $r->tags);
            if($r->has('image')){
                $ImageName = $BookData['slug'].'.'.$r->image->getClientOriginalExtension();
                $img = ImageLib::make($r->image);
                // backup status
                $img->backup();
                // Tiny Thumb
                $img->fit(60, 60);
                $img->save('storage/app/public/books/images/small_thumb/'.$ImageName);
                $img->reset();
                // Thumb
                $img->fit(250, 250);
                $img->save('storage/app/public/books/images/thumb/'.$ImageName);
                $img->reset();
                // Full Size
                $img->fit(650, 650);
                $img->save('storage/app/public/books/images/full_size/'.$ImageName);
                $img->reset();
                $BookData['image'] = $ImageName;
            }
            $TheBook->update($BookData);
            return redirect()->route('admin.books.all')->withSuccess('Book Created Successfully');
        }
    }
    public function getBorrowsRequests(){
        $AllRequests = BooksBorrow::where('status', 'pending')->get();
        return view('admin.borrows.requests', compact('AllRequests'));
    }
    public function getAcceptBorrow($id){
                /**
         * Accept borrow request
         *
         * @param  integer $id (book id)
         * @return all book page
         */
        $TheRequest = BooksBorrow::find($id);
        if($TheRequest->status == "canceled"){
            return redirect()->route('admin.borrows.all')->withErrors('Request canceled from user');
        }
        if(!$TheRequest->Book->exists){
            return redirect()->route('admin.borrows.all')->withErrors('Book not available');
        }
        $TheRequest->update([
            'status' => 'accepted',
        ]);
        $TheRequest->Book->update([
            'user_id' => auth()->user()->id,
            'borrowed' => 1,
        ]);
        return redirect()->route('admin.borrows.all')->withSuccess('Book Borrowed Successfully');
    }
    public function getRefuseBorrow($id){
                /**
         * get all borrow requests page
         *
         * @param  integer $id (borrow reuqest id)
         * @return all borrowed requests page
         */
        $TheRequest = BooksBorrow::find($id);
        if(!$TheRequest->Book->exists){
            return redirect()->route('admin.borrows.all')->withErrors('Book not available');
        }
        $TheRequest->update([
            'status' => 'refused',
        ]);
        return redirect()->route('admin.borrows.all')->withSuccess('Request Refused Successfully');
    }
    public function getReverseRequests(){
            /**
         *get all reversed requests page
         *
         * @return all reversed requests page
         *
         * @throws \Exception
         */
        $AllRequests = BooksBorrow::where('status', 'pending_reverse')->get();
        return view('admin.reverse.requests', compact('AllRequests'));
    }
    public function getAcceptReverse($id){
        /**
         * accept reverse request
         *
         * @param  integer $id (request id)
         * @return all reverse requests
         */
        $TheRequest = BooksBorrow::find($id);
        if(!$TheRequest->Book->exists){
            $TheRequest->update([
                'status' => 'reversed',
            ]);
            return redirect()->route('admin.reverse.all')->withSuccess('The book reversed but it not found in books system');
        }
        $TheRequest->update([
            'status' => 'reversed',
        ]);
        $TheRequest->Book->update([
            'user_id' => NULL,
            'borrowed' => 0,
        ]);
        return redirect()->route('admin.reverse.all')->withSuccess('Book Reversed Successfully');
    }
    public function deleteBook($id){
        Book::find($id)->delete();
        return redirect()->route('admin.books.all')->withSuccess('Book Deleted Successfully');
    }
}
