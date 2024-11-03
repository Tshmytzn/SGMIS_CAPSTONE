<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionMaterials extends Model
{
    use HasFactory;
    protected $table = 'election_materials';
    protected $primaryKey = 'id';

    protected $fillable = [
        'election_id',
        'file_name',
    ];
}
