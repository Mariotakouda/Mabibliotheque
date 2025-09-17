<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 
        'author', 
        'published_at', 
        'isbn', 
        'cover_path', 
        'summary', 
        'total_copies', 
        'available_copies', 
        'category_id'
    ];

    protected $casts = [
    'published_at' => 'datetime',
];


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function borrowings() {
        return $this->hasMany(Borrowing::class);
    }
}
