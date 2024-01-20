<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OldacType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function oldacnames(): HasMany
    {
        return $this->hasMany(OldacName::class);
    }

    public function oldtransactions(): HasMany
    {
        return $this->hasMany(OldTransaction::class);
    }
}
