<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrisEmployeePresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'hris_employee_id',
        'presence_date',
        'presence_type',
        'drafted',
        'actived',
    ];
}
