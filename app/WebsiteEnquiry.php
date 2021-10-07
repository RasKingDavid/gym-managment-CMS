<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteEnquiry extends Model
{
    protected $table = 'website_enquiry';
    protected $fillable = ['name','email','subject','message'];
}
