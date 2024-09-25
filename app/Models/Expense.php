<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'type',
    ];

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
}
