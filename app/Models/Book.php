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
        return url('storage/app/public/books/images/small_thumb/'.$this->image);
    }
    public function getThumbAttribute(){
        return url('storage/app/public/books/images/thumb/'.$this->image);
    }
    public function getFullSizeAttribute(){
        return url('storage/app/public/books/images/full_size/'.$this->image);
    }
    public function getBookDescriptionAttribute(){
        return Str::limit($this->description, Book::LIMIT);
    }
}
