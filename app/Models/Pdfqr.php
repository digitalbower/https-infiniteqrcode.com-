<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdfqr extends Model
{
    use HasFactory;

    protected $table = 'pdfqr';

    protected $fillable = [
        'code','qrtype', 'codeText','pdfpath', 'url','qrimage','userid'
    ];
}
