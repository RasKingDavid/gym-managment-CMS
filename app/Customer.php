<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name','email','phone','address','member_id','extra2','extra3','extra4'];
}
