<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaqr extends Model
{
    use HasFactory;

    protected $table = 'socmedqr';

    protected $fillable = [
        'code','qrtype', 'whtext','whurl','fbtext','fburl','ybtext','yturl','insurl',
        'instext','wchurl','wchtext','tikurl','tiktext',
        'dyurl','dytext','telurl','teltext','snpurl','snptext',
        'url','qrimage','userid'
    ];
}
