<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class PosInvoiceProducts extends Model
{
    protected $table = 'pos_invoice_products';
    protected $fillable = ['invoice_id','customer_id','product_id','quantity'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
