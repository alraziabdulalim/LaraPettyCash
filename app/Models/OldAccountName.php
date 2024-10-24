<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OldAccountName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        's_name',
        'parent_id',
        'trans_type',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(OldAccountName::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(OldAccountName::class, 'parent_id');
    }
}
