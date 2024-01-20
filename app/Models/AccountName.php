<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountName extends Model
{
    use HasFactory;

    public function transtype():BelongsTo
    {
        return $this->belongsTo(TransType::class);
    }

    public function accounttype():BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }

    public function accountcategory():BelongsTo
    {
        return $this->belongsTo(AccountCategory::class);
    }
    
    public function transactions():HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
