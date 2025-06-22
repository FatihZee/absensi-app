<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id', 'action', 'timestamp', 'log_detail',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}