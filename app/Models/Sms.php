<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sms extends Model
{
    use HasFactory;

    protected $table = 'smsqr';

    protected $fillable = [
        'code','qrtype', 'qrsms','countrycode', 'phonenumber', 'url','qrimage','userid','created_At',
    ];
}
