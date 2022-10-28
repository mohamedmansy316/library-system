<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    const LIMIT = 100;
    public function getSmallThumbAttribute(){
        /**
         * get small thumb image of book
         *
         * @return small thumb image of book
         */
        return url('storage/app/public/books/images/small_thumb/'.$this->image);
    }
    public function getThumbAttribute(){
            /**
         * get thumb image of book
         *
         * @return thumb image of book
         */
        return url('storage/app/public/books/images/thumb/'.$this->image);
    }
    public function getFullSizeAttribute(){
        /**
         * get full size image of book
         *
         * @return full size image of book
         */
        return url('storage/app/public/books/images/full_size/'.$this->image);
    }
    public function getBookDescriptionAttribute(){
        /**
         * get short description of the book
         *
         * @return get short description of the book
         */
        return Str::limit($this->description, Book::LIMIT);
    }
    public function BookBorrow(){
        /**
         * relation: Book has mansy borrows
         *
         * @return related book
         *
         */
        return $this->hasMany(BooksBorrow::class, 'book_id')->withDefault([
            'title' => 'Deleted Book',
            'isbn' => 'Deleted Book',
        ]);
    }
    public function BookReverse(){
        /**
         * relation: Book has mansy returns
         *
         * @return related book
         *
         */
        return $this->hasMany(BookReverse::class, 'book_id');
    }
}
