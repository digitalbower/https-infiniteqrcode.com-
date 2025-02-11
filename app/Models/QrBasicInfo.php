<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrBasicInfo extends Model
{
    protected $table = 'qr_basic_info'; // Define table name explicitly

    protected $primaryKey = 'id'; // Primary key

    public $timestamps = false; // Disable automatic timestamps if 'created_At' is manually set

    protected $fillable = [
        'project_code',
        'project_name',
        'folder_name',
        'qrtype',
        'start_date',
        'end_date',
        'usage_type',
        'remarks',
        'url',
        'userid',
        'qrtable',
        'total_scans',
        'unique_scans',
        'created_At',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
