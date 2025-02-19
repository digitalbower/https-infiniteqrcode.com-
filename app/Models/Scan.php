<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'scans';

    protected $fillable = [
        'qr_code_id','user_agent', 'device_identifier','scan_date'
    ];
}
