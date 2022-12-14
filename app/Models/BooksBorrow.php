<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksBorrow extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Book(){
        /**
         * relation: borrow request belongs to one book
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
         * relation: borrow request belongs to one user
         *
         * @return related book
         *
         */
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Deleted user',
        ]);
    }
}
