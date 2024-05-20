<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compendium extends Model
{
    use HasFactory;
    protected $table = 'compendium';
    protected $primaryKey = 'com_id';
    protected $fillable = [
      'event_id',
      'com_name',
 
    ];
}
