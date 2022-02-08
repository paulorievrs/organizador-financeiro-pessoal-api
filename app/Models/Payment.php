<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'payed_at',
        'expense_id'
    ];

    public function expanse(): BelongsTo
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
