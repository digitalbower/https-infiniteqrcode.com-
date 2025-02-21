<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScanStatistics extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'scan_statistics';

    protected $fillable = [
        'code','city', 'country','scan_count', 'scandate'
    ];
}
