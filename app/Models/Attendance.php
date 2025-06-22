<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'date', 'check_in_time',
        'check_out_time', 'check_in_photo', 'check_out_photo',
        'location', 'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function logs()
    {
        return $this->hasMany(AttendanceLog::class);
    }
}