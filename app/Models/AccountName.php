<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'parent_id',
        'trans_type',
        'account_group',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function topAccount(): BelongsTo
    {
        return $this->belongsTo(AccountName::class, 'parent_id');
    }

    public function downAccount(): HasMany
    {
        return $this->hasMany(AccountName::class, 'parent_id');
    }
}
