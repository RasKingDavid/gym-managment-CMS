<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopInvoiceItems extends Model
{
    protected $table = 'shop_invoice_items';
    protected $fillable = ['invoice_id','customer_id','product_name','product_sku','quantity','price'];

    public function product(){
        return $this->belongsTo(Product::class,'product_sku','sku');
    }
}
