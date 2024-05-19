<?php

namespace App\Domain\Store\Models;

use App\Domain\Book\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
    protected $fillable = [
        'name',
        'address',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_store');
    }
}
