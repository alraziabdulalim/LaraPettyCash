<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountCategory extends Model
{
    use HasFactory;

    public function accountNames():HasMany
    {
        return $this->hasMany(AccountName::class);
    }
}
