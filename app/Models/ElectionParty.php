<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionParty extends Model
{
    use HasFactory;
    protected $table = 'election_party';
    protected $primaryKey = 'party_id';

    protected $fillable = [
        'party_name',
        'party_desciption',
        'candi_picture',
        'party_status',
    ];
}
