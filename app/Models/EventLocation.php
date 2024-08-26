<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLocation extends Model
{
    use HasFactory;
    protected $table = 'event_location';
    protected $primaryKey = 'l_id';
    protected $fillable = [
       'location_name',
       'latitude',
       'longitude',
       'lrange',
       'status',
    ];
}
