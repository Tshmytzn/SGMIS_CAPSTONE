<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
  use HasFactory;

  protected $table = 'admin';
  protected $primaryKey = 'admin_id';
  public $incrementing = false; // Indicates UUID is not auto-incrementing
  protected $keyType = 'string'; // Sets the primary key type to string for UUID

  protected $fillable = [
    'admin_name',
    'admin_school_id',
    'admin_username',
    'admin_password',
    'admin_type',
    'admin_pic',
  ];
}
