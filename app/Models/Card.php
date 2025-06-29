<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'tab_id',
    ];

    public function tab(): BelongsTo
    {
        return $this->belongsTo(Tab::class);
    }
}
