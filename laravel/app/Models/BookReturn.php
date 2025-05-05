<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'return_date'];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
