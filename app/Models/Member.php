<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'name',
        'is_person_in_charge',
    ];

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
}
