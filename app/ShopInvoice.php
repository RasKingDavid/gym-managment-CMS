<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class ShopInvoice extends Model
{
    protected $table = 'shop_invoices';
    protected $fillable = ['customer_id','total','tax_amount','checked','sold_by'];

    public function buyer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function seller(){
        return $this->belongsTo(User::class,'sold_by','id');
    }
    
}
