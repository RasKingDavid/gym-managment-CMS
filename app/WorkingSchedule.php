<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingSchedule extends Model
{
    protected $table = 'working_schedules';
    protected $fillable = ['member_id','day','time'];
}