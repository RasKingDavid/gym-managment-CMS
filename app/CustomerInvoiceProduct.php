<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInvoiceProduct extends Model
{
    protected $table = 'customer_invoice_products';
    protected $fillable = ['invoice_id','customer_id','product_id','quantity'];
}
