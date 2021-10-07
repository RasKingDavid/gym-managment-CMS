<?php

namespace App\Http\Controllers;

use App\Product;

use App\Setting;
use App\Customer;
use App\PosInvoice;
use App\Http\Requests;
use App\CustomerInvoice;
use App\PosInvoiceProducts;
use Illuminate\Http\Request;
use App\CustomerInvoiceProduct;
use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function index(){
        $invoices = PosInvoice::with('customer','seller')->latest()->get();
        // return $invoices;
        return view('pos.index', compact('invoices'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('product_name','asc')->get();
        $customers = Customer::get();
        $set_tax = Setting::where('key','taxes')->first();
        return view('pos.create', compact('products','customers','set_tax'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // generate invoice
        $invoice = PosInvoice::create([
            'customer_id' => $request->customer_id,
            'invoice_number' => $request->invoice_number,
            'sold_by' => auth()->user()->id,
            'sub_total' => $request->sub_total,
            'discount' => $request->discount,
            'total_amount' => $request->total_amount,
            'tax' => $request->tax,
            'grand_total' => $request->grand_total,
            'payment_method' => $request->payment_method,
            'paid' => $request->paid,
            'change_amount' => $request->change_amount,
            'due' => $request->due
        ]);
        // add products under invoice
        foreach($request->product_id as $key=>$item){
            PosInvoiceProducts::create([
                'invoice_id' => $invoice->id,
                'customer_id' => $invoice->customer_id,
                'product_id' => $request->product_id[$key],
                'quantity' => $request->quantity[$key]
            ]);
        }
        $customer = Customer::find($invoice->customer_id);
        $items = PosInvoiceProducts::with('product')->where('invoice_id',$invoice->id)->where('customer_id',$invoice->customer_id)->get();
        $set_tax = Setting::where('key','taxes')->first();
        return view('pos.invoice', compact('invoice','items','customer','set_tax'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pos_print($id)
    {
        $invoice = PosInvoice::with('seller')->find($id);
        $customer = Customer::find($invoice->customer_id);
        $items = PosInvoiceProducts::with('product')->where('invoice_id',$invoice->id)->where('customer_id',$invoice->customer_id)->get();
        $set_tax = Setting::where('key','taxes')->first();
        // return $invoice;
        return view('pos.invoice', compact('invoice','items','customer','set_tax'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
