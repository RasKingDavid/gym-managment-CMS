<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'users_details';
    protected $fillable = ['user_id', 'image'];


     public function user()
    {
        return $this->belongsTo('App\User');
    }

}
