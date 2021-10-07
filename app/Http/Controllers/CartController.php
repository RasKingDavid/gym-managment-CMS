<?php

namespace App\Http\Controllers;

use App\Product;

use App\Setting;
use App\ShopInvoice;
use App\Http\Requests;
use App\ShopInvoiceItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        // return $id;
        $product = Product::find($id);
        $rowId = uniqid();
        $userID = session()->get('customer')['id'];
        $product_sku = $product->sku;
        \Cart::add(array(
            'id' => $rowId,
            'name' => $product->product_name,
            'price' => $product->sale_price,
            'quantity' => 1,
            'attributes' => array(
                'userID' => $userID,
                'product_sku' => $product_sku
            ),
            'associatedModel' => $product
        ));
        return redirect()->back();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all_items()
    {
        $items = \Cart::getContent();
        $total = \Cart::getTotal();
        $tax_amount = Setting::where('key','taxes')->first();
        return view('website.shop.cart', compact('items','total','tax_amount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove_item($id)
    {
        \Cart::remove($id);
        return redirect()->back();
    }

    public function increase_item($id){
        // return $id;
        \Cart::update($id,[
            'quantity' => 1,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $items = \Cart::getContent();
        $total = \Cart::getTotal();
        $tax_amount = Setting::where('key','taxes')->first();
        $tax_total = $total*($tax_amount->value/100);
        $total = $total+$total*($tax_amount->value/100);
        // return $total;
        if($total > 0){
            // generate invoice
                $invoice = ShopInvoice::create([
                    'customer_id' => session()->get('customer')['id'],
                    'total' => $total,
                    'tax_amount' => $tax_total
                ]);
            // ends

            // add items under the invoice
                foreach($items as $item){
                    ShopInvoiceItems::create([
                        'invoice_id' => $invoice->id,
                        'customer_id' => session()->get('customer')['id'],
                        'product_name' => $item->name,
                        'product_sku' => $item->attributes->product_sku,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                    $current_stock = Product::where('sku',$item->attributes->product_sku)->first();
                    Product::where('sku',$item->attributes->product_sku)->update([
                        'stock' => $current_stock->stock - $item->quantity
                    ]);
                }
            // ends

            // empty the card as the shopping
                foreach($items as $item){
                    \Cart::remove($item->id);
                }
            // ends
            // return $invoice;
            return view('website.shop.checkout',compact('invoice','tax_amount'));
        }else{
            return redirect('/');
        }
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
