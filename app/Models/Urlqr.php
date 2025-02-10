<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urlqr extends Model
{
    use HasFactory;

    protected $table = 'urlcode';

    protected $fillable = [
        'code','qrtype', 'qrurl','url','qrimage','userid'
    ];
}
