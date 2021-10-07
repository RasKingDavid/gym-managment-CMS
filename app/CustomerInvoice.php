<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInvoice extends Model
{
    protected $table = 'customer_invoices';
    protected $fillable = ['customer_id','sale_id','total','discount','total_amount','status','paid','credit'];
}
