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
class AdminController extends Controller
{
    public function getAdmin(){
        return view('admin.index');
    }
    public function getAllBooks(){
        $AllBooks = Book::all();
        return view('admin.books.all', compact('AllBooks'));
    }

    public function getCreateBook(){
        return view('admin.books.new');
    }
    public function postCreateBook(Request $r){
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
        $TheBook = Book::findOrFail($id);
        return view('admin.books.edit' , compact('TheBook'));
    }
    public function postEditBook(Request $r, $id){
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
            $BookData =  $r->except('gallery');
            $BookData['slug'] = $TheBook->slug;
            $BookData['tags'] = str_replace(',' , ' ' , $r->tags);
            if($r->has('image')){
                $img = ImageLib::make($r->image);
                // backup status
                $img->backup();
                // Tiny Thumb
                $img->fit(60, 60);
                $img->save('storage/app/public/books/images/small_thumb/'.$BookData['slug'].'.'.$r->image->getClientOriginalExtension());
                $img->reset();
                // Thumb
                $img->fit(250, 250);
                $img->save('storage/app/public/books/images/thumb/'.$BookData['slug'].'.'.$r->image->getClientOriginalExtension());
                $img->reset();
                // Full Size
                $img->fit(650, 650);
                $img->save('storage/app/public/books/images/full_size/'.$BookData['slug'].'.'.$r->image->getClientOriginalExtension());
                $img->reset();
                $BookData['image'] = $BookData['slug'].'.'.$r->image->getClientOriginalExtension();
            }
            $TheBook->update($BookData);
            return redirect()->route('admin.books.all')->withSuccess('Book Created Successfully');
        }
    }
    public function getBorrowsRequests(){
        $AllRequests = BooksBorrow::where('status', 'pending')->get(); //Consider exporting the logic to sperate function in the model (maybe)
        return view('admin.borrows.requests', compact('AllRequests'));
    }
    public function getAcceptRequest($id){
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
    public function getRefuseRequest($id){
        $TheRequest = BooksBorrow::find($id);
        if(!$TheRequest->Book->exists){
            return redirect()->route('admin.borrows.all')->withErrors('Book not available');
        }
        $TheRequest->update([
            'status' => 'refused',
        ]);
        return redirect()->route('admin.borrows.all')->withSuccess('Request Refused Successfully');
    }
    public function deleteBook($id){
        Book::find($id)->delete();
        return redirect()->route('admin.books.all')->withSuccess('Book Deleted Successfully');
    }
}
