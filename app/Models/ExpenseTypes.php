<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTypes extends Model
{
    use HasFactory;
    protected $table = 'expense_types';
    protected $fillable = [
      'name'
    ];
}
