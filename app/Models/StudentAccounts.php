<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccounts extends Model
{
    use HasFactory;
    protected $table = 'student_accounts';
    protected $primaryKey = 'student_id';
    protected $fillable = [
       'school_id',
       'sect_id',
       'student_firstname',
       'student_middlename',
       'student_lastname',
       'student_ext',
       'student_pass',
       'student_pic',
    ];
}
