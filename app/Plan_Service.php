<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_Service extends Model
{
    protected $table = 'plan__services';
    protected $fillable = ['plan_id', 'service_id'];

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
