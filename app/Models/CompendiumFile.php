<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompendiumFile extends Model
{
    use HasFactory;
    protected $table = 'compendium_files';
    protected $primaryKey = 'com_file_id';
    protected $fillable = [
      'com_id',
      'file_name',
    ];
}
