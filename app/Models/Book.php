<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'slug', 'author', 'publisher', 'publication_year', 
        'category', 'description', 'stock', 'max_loan_days', 
        'fine_per_day', 'cover_image'
    ];

    public function loans() {
        return $this->hasMany(Loan::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // Helper untuk menghitung rata-rata rating (Rekomendasi)
    public function getAverageRatingAttribute() {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
