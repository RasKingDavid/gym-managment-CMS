<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class PosInvoice extends Model
{
    protected $table = 'pos_invoices';
    protected $fillable = ['customer_id','invoice_number','sold_by','sub_total','discount','total_amount','tax','grand_total','payment_method','paid','change_amount','due'];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function seller(){
        return $this->belongsTo(User::class,'sold_by','id');
    }
}
