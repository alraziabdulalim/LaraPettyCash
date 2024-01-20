<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OldacName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'oldactype_id',
    ];

    public function oldactype():BelongsTo
    {
        return $this->belongsTo(OldacType::class);
    }

    public function oldtransactions(): HasMany
    {
        return $this->hasMany(OldTransaction::class);
    }
}
