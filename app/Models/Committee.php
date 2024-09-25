<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_members',
    ];

    // Relationship with members
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    // Relationship with expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
