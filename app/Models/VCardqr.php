<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VCardqr extends Model
{
    use HasFactory;

    protected $table = 'vcard';

    protected $fillable = [
        'code','qrtype', 'contactimg','first_name','last_name','mobile','email','company','street',
        'website','city','zip','state','country','url','qrimage','userid'
    ];
}
