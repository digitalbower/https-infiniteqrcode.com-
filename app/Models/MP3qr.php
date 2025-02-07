<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MP3qr extends Model
{
    use HasFactory;

    protected $table = 'mp3qr';

    protected $fillable = [
        'code','qrtype', 'qrtext','mp3path', 'url','qrimage','userid'
    ];
}
