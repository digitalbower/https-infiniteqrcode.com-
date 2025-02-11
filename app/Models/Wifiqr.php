<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wifiqr extends Model
{
    use HasFactory;

    protected $table = 'wifiqr';

    protected $fillable = [
        'code','qrtype', 'ssid','password', 'enctype','url','qrimage','userid'
    ];
}
