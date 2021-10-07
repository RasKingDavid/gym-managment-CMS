<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberDetail extends Model
{
     protected $table = 'member_details';

    protected $fillable = [
        'member_id',
        'image',
        'proof_image',
    ];

       public function member()
    {
        return $this->belongsTo('App\Member');
    }

}
