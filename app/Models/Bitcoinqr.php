<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitcoinqr extends Model
{
    use HasFactory;

    protected $table = 'btcqr';

    protected $fillable = [
        'code','qrtype', 'btcaddr','btcnetwrk', 'currency','quantity','url','qrimage','userid'
    ];
}
