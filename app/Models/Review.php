<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'comment',
    ];

    /**
     * Relasi: Review dimiliki oleh satu User (Mahasiswa).
     * Digunakan di view: $review->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    /**
     * Relasi: Review tertuju pada satu Buku.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}