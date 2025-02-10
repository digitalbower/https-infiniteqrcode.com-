<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emailqr extends Model
{
    use HasFactory;

    protected $table = 'emailqr';

    protected $fillable = [
        'code','qrtype', 'email','subject', 'message','url','qrimage','userid'
    ];
}
