<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OldTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'oldacname_id',
        'oldactype_id',
        'amount',
        'details',
        'voucher_at',
    ];

    public function oldacname ():BelongsTo
    {
        return $this->belongsTo(OldacName::class);
    }

    public function oldactype ():BelongsTo
    {
        return $this->belongsTo(OldacType::class);
    }
}
