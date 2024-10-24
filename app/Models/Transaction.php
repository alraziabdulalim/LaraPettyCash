<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name_id',
        'trans_type',
        'amount',
        'details',
        'voucher_at',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function accountName ():BelongsTo
    {
        return $this->belongsTo(AccountName::class);
    }
    public function oldAccountName ():BelongsTo
    {
        return $this->belongsTo(OldAccountName::class);
    }
}
