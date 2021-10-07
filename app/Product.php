<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id','sku','product_name','description','image','purchase_price','sale_price','min_stock','stock','discount_price'];

    public function category(){
        return $this->belongsTo(Category::Class,'category_id','id');
    }
}
