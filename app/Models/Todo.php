<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Todo extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'text',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function scopeSearch($query, $search = ''): void
//    {
//        $query->where('text', 'like', "%{$search}%");
//    }
}
