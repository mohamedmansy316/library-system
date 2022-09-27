<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReverse extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'book_id', 'status'];
    public function Book(){
        /**
         * relation: reverse request belongs to one book
         *
         * @return related book
         *
         */
        return $this->belongsTo(Book::class, 'book_id')->withDefault([
            'title' => 'Deleted Book',
            'isbn' => 'Deleted Book',
        ]);
    }
    public function User(){
        /**
         * relation: reverse request belongs to one user
         *
         * @return related user
         *
         */
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Deleted user',
        ]);
    }

}
