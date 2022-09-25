<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksBorrow extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function Book(){
        return $this->belongsTo(Book::class, 'book_id')->withDefault([
            'title' => 'Deleted Book',
        ]);
    }
    public function User(){
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Deleted user',
        ]);
    }
}
