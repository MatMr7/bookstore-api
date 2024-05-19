<?php

namespace App\Domain\Book\Models;

use App\Domain\Store\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    protected $fillable = [
        'name',
        'isbn',
        'value'
    ];

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class, 'book_store');
    }
}
