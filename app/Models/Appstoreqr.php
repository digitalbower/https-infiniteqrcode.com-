<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appstoreqr extends Model
{
    use HasFactory;

    protected $table = 'apkqr';

    protected $fillable = [
        'code','qrtype', 'appurl','playstoreurl', 'windowsurl','Huawei','url','qrimage','userid'
    ];
}
