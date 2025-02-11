<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageqr extends Model
{
    use HasFactory;

    protected $table = 'imageqr';

    protected $fillable = [
        'code','qrtype', 'qrtext','imagepath', 'url','qrimage','userid'
    ];
}
