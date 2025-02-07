<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videoqr extends Model
{
    use HasFactory;

    protected $table = 'videoqr';

    protected $fillable = [
        'code','qrtype', 'qrtext','videopath', 'url','qrimage','userid'
    ];
}
