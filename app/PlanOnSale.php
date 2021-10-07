<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanOnSale extends Model
{
    protected $table = 'plan_on_sales';

    protected $fillable = ['plan_id', 'amount', 'discount', 'month'];

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
