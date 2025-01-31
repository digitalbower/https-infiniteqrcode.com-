<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QRCode extends Model
{
    use HasFactory;

    protected $table = 'qrcodes';


    protected $fillable = [
        'countrycode', 'phone', 'sms', 'projectname', 'folderinput',
        'startdate', 'enddate', 'usage', 'remarks','qr_code_svg'
    ];
}
