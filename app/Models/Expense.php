<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable = [
        'description',
        'value',
        'type_id',
        'is_archived',
        'month',
        'deadline',
        'user_id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ExpenseTypes::class, 'type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'expense_id');
    }

}
