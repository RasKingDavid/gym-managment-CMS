<?php

namespace App\Http\Controllers;

use App\Plan;

use App\Product;
use App\Setting;
use App\Customer;
use App\NewsLetter;
use App\PlanOnSale;
use App\ShopInvoice;
use App\Http\Requests;
use App\WebsiteEnquiry;
use App\ShopInvoiceItems;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('website.index');
    }

    public function getClasses()
    {
        $plans = Plan::where('status', 1)->paginate(4);
        // dd($plans);
         return view('website.classes', ['plans' => $plans]);
    }

     public function getAboutUs()
    {
         return view('website.aboutUs');
    }

     public function getNews()
    {
         return view('website.news');
    }

     public function getContact()
    {
         return view('website.contact');
    }

     public function subscribeNewsletter(Request $request)
    {
        // dd($request->all());
        // if($request->ajax()) {
        $existingEmail = NewsLetter::where('email', $request->newsletter)->first();
        if ($existingEmail) {
            return response()->json(['error' =>  $request->newsletter.' is already taken'], 201);
        }
         
          $newsletter = new NewsLetter();
          $newsletter->email = $request->newsletter;
          $newsletter->save();
          return response()->json(['success' => 'Thank you for subscribing to our newsletter' .$request->get('email')], 200);
    // }

    }

    public function planSelected($id)
    {
        $plans = Plan::where('id', $id)->first();
        // dd($plans);
        $plansonsale = PlanOnSale::where('plan_id', $id)->get();
        return view('website.online.member.plan', ['plans' => $plans, 'plansonsale' => $plansonsale] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function website_enquiries_index(){
        $web_enquiries = WebsiteEnquiry::latest()->get();
        return view('enquiries.website', compact('web_enquiries'));
    }

    public function send_enquiry(Request $request){
        // return $request->all();
        $data = 'Welcome to First Fitness Center. We are currently testing our various features from the app. Thank you for your interest in first fitness. Soon we will get back to you with a perfect plan.';
        Mail::send('mails.website.enquiry',['data' => $data], function ($message) {    
            $message->from('noreplyfirstfitness@gmail.com', 'FirstFitness');
            $message->to('icecooldavid3@gmail.com')
                    ->subject('Greetings From First Fitness');;
        });
        WebsiteEnquiry::create($request->all());
        flash()->success('Message sent successfully');
        return redirect()->back();
    }

    public function customer_new_orders(){
        $newOrders = ShopInvoice::with('buyer')->where('checked','no')->get();
        $allOrders = ShopInvoice::with('buyer')->where('checked','yes')->get();
        // return $newOrders;
        return view('dashboard.orders.index', compact('newOrders','allOrders'));
    }

    public function customer_order_products($id){
        // ShopInvoice::where('id', $id)->update([
        //     'checked' => 'yes'
        // ]);
        $set_tax = Setting::where('key','taxes')->first();
        $invoice = ShopInvoice::find($id);
        $products = ShopInvoiceItems::where('invoice_id',$id)->get();
        return view('dashboard.orders.view', compact('products','invoice','set_tax'));
    }

    public function customer_order_confirm($id){
        // assigning seller
        ShopInvoice::where('id', $id)->update([
            'checked' => 'yes',
            'sold_by' => auth()->user()->id
        ]);
        $invoice = ShopInvoice::with('seller')->find($id);
        // return $invoice;
        $items = ShopInvoiceItems::with('product')->where('invoice_id',$id)->get();
        $customer = Customer::find($invoice->customer_id);
        $set_tax = Setting::where('key','taxes')->first();
        foreach($items as $product){
            $stock_product = Product::where('sku',$product->product_sku)->first();
            if($product->quantity > $stock_product->stock){
                ShopInvoice::where('id', $id)->update([
                    'checked' => 'no',
                    'sold_by' => 0
                ]);
                flash()->success('Product stock out. Cannot create invoice, please update your stock');
                return redirect()->back();
            }
        }
        
        // product quantity deduction
        foreach($items as $item){
            $product = Product::where('sku',$item->product_sku)->first();
            Product::where('sku',$item->product_sku)->update([
                'stock' => $product->stock - $item->quantity
            ]);
        }
        // return $invoice;
        return view('dashboard.orders.shopInvoice', compact('invoice','items','customer','set_tax'));
    }

    public function customer_order_cancel($id){
        $invoice = ShopInvoice::where('id',$id)->update([
            'checked' => 'canceled'
        ]);
        flash()->success('Order Cancelled');
        return redirect()->route('new.orders');
    }

    public function customer_order_invoice_print($id){
        $invoice = ShopInvoice::with('seller')->find($id);
        // return $invoice;
        $items = ShopInvoiceItems::with('product')->where('invoice_id',$id)->get();
        $customer = Customer::find($invoice->customer_id);
        $set_tax = Setting::where('key','taxes')->first();
        return view('dashboard.orders.shopInvoice', compact('invoice','items','customer','set_tax'));
    }



}
