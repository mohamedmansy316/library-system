<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function hasRequestedBook($book_id){
        return BooksBorrow::where([
            ['book_id' , $book_id],
            ['user_id' , $this->id],
            ['status', 'pending']
        ])->count() ? true : false;
    }
    // Relations
    public function Orders (){
        /**
         * relation: user has many borroes reuests
         *
         * @return related Books Borrow
         *
         */
        return $this->hasMany(BooksBorrow::class, 'user_id');
    }
}
