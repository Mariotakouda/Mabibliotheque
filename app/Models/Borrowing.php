<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_at',
        'returned_at',
        'status',
        'penalty_amount',
    ];

    protected $casts = [
        'borrowed_at'    => 'datetime',
        'due_at'         => 'datetime',
        'returned_at'    => 'datetime',
        'penalty_amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue(): bool
    {
        return ! $this->returned_at && $this->due_at->isPast();
    }
}
