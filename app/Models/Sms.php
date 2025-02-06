<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sms extends Model
{
    use HasFactory;

    protected $table = 'smsqr';

    protected $fillable = [
        'countrycode', 'phonenumber', 'qrsms', 'project_name', 'start_date', 'end_date', 'usage', 'remarks', 'qr_code_path'
    ];
}
