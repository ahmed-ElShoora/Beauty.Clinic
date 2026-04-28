<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day_of_week',
        'is_closed'
    ];

    public function slots()
    {
        return $this->hasMany(ScheduleSlot::class);
    }
}
