<?php

namespace App\Http\Controllers;

use App\Member;
use App\Invoice;
use App\Customer;
use App\ShopInvoice;
use App\WorkingSchedule;
use App\ShopInvoiceItems;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Subscription;
use \Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $customer = Customer::find(Session::get('customer')['id']);
        if($customer->member_id != null){
            $is_member = true;
        }else{
            $is_member = false;
        }
        $invoices = Invoice::where('member_id',session()->get('customer')['member_id'])->get();
        // return $invoices;
        $subscription = Subscription::where('member_id',Session::get('customer')['id'])->first();
        // return $subscription;
        $subInvoice = Invoice::find($subscription->invoice_id);
        // return $subInvoice;
        // check subscription
        $subEnd = Carbon::parse($subscription->end_date);
        $toDay = Carbon::now();
        $subStatus = $toDay->gt($subEnd);
        // ends
        // return $paid_amount;
        return view('website.customer.dashboard.index',compact('customer','is_member','invoices','subStatus','subscription','subInvoice'));
    }
    public function showLoginForm()
    {
        return view('website.customer.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login_attempt(Request $request)
    {
        // return $request->all();

        $pass_check = Customer::where('email',$request->email)->exists();
        // dd($pass_check);
        if($pass_check){
            $hashed = Customer::where('email',$request->email)->first();
            $check = Hash::check($request->password,$hashed->password);
            if($check){
                $name = explode(" ",$hashed->name);
                $logo = "";
                foreach($name as $n) {
                    $logo .=$n[0];
                }
                Session::put('customer',[
                    'id' => $hashed->id,
                    'logo' => $logo,
                    'member_id' => $hashed->member_id
                ]);
                if(Session::has('visiting_shop')){
                    return redirect()->route('shop.index');
                }
                return redirect()->route('customer.dashboard');
            }else{
                flash()->warning('Password did not match!');
                return redirect()->route('customer.login');
            }
        }else{
            flash()->warning('User not found, please register!');
            return redirect()->route('customer.register');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('website.customer.auth.register');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register_attempt(Request $request)
    {
        // return $request->all();
        // password verification
        if($request->password != $request->confirm_password){
            flash()->error('Password did not match!');
            return redirect()->back();
        }else{
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            // membership check 
            $member_check = Member::where('email',$request->email)->first();
            if(isset($member_check)){
                $customer->member_id = $member_check->id;
            }
            // ends
            $customer->save();
            flash()->success('You have registered successfully, please login into your account');
            return redirect()->route('customer.login');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer_logout()
    {
        Session::flush();
		flash()->success('You have logged out successfully');
		return redirect()->route('customer.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shopping_history()
    {
        $customer = Customer::find(Session::get('customer')['id']);
        $invoices = ShopInvoice::where('customer_id',$customer->id)->orderBy('total','desc')->get();
        return view('website.customer.invoices.index',compact('invoices','customer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shopped_products($id)
    {
        $customer = Customer::find(Session::get('customer')['id']);
        $invoice = ShopInvoice::find($id);
        $items = ShopInvoiceItems::where('invoice_id', $id)
                                ->where('customer_id', session()->get('customer')['id'])
                                ->get();
        return view('website.customer.invoices.products', compact('items','customer','id','invoice'));
    }

    public function working_schedule(){
        // return session()->get('customer')['id'];
        $member_ship_id = session()->get('customer')['id'];
        $customer = Customer::find(Session::get('customer')['id']);
        // return $customer;
        $schedules = WorkingSchedule::where('member_id', $customer->member_id)->get();
        return view('website.customer.dashboard.working_schedule.view', compact('schedules','customer'));
    }

    public function member_invoice($id){
        $invoice = Invoice::with('member')->findOrFail($id);
        $settings = \Utilities::getSettings();
        // return $settings;
        return view('invoices.show', compact('invoice', 'settings'));
    }
}
