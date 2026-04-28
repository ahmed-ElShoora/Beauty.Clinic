<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleSlot extends Model
{
    protected $fillable = [
        'schedule_id',
        'start_time',
        'end_time'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
