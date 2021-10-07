<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Member;
use JavaScript;
use App\Enquiry;
use App\Invoice;
use App\Service;
use App\Setting;
use App\Customer;
use Carbon\Carbon;
use App\SmsTrigger;
use App\ChequeDetail;
use App\MemberDetail;
use App\Subscription;
use App\InvoiceDetail;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $members = Member::indexQuery($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.index', compact('members', 'count', 
        'drp_placeholder'));
    }

    public function active(Request $request)
    {
        $members = Member::active($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.active', compact('members', 'count', 
        'drp_placeholder'));
    }

    public function inactive(Request $request)
    {
        $members = Member::inactive($request->sort_field, $request->sort_direction, $request->drp_start, $request->drp_end)->search('"'.$request->input('search').'"')->paginate(10);
        $count = $members->total();

        $drp_placeholder = $this->drpPlaceholder($request);

        $request->flash();

        return view('members.inactive', compact('members', 'count',
         'drp_placeholder'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // For Tax calculation
        JavaScript::put([
            'taxes' => \Utilities::getSetting('taxes'),
            'gymieToday' => Carbon::today()->format('Y-m-d'),
            'servicesCount' => Service::count(),
        ]);

        //Get Numbering mode
        $invoice_number_mode = \Utilities::getSetting('invoice_number_mode');
        $member_number_mode = \Utilities::getSetting('member_number_mode');

        //Generating Invoice number
        if ($invoice_number_mode == \constNumberingMode::Auto) {
            $invoiceCounter = \Utilities::getSetting('invoice_last_number') + 1;
            $invoicePrefix = \Utilities::getSetting('invoice_prefix');
            $invoice_number = $invoicePrefix.$invoiceCounter;
        } else {
            $invoice_number = '';
            $invoiceCounter = '';
        }

        //Generating Member Counter
        if ($member_number_mode == \constNumberingMode::Auto) {
            $memberCounter = \Utilities::getSetting('member_last_number') + 1;
            $memberPrefix = \Utilities::getSetting('member_prefix');
            $member_code = $memberPrefix.$memberCounter;
        } else {
            $member_code = '';
            $memberCounter = '';
        }

        return view('members.create', compact('invoice_number', 'invoiceCounter', 'member_code', 'memberCounter', 'member_number_mode', 'invoice_number_mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // Member Model Validation
        $this->validate($request, ['email' => 'unique:mst_members,email',
                                   'contact' => 'unique:mst_members,contact',
                                   'member_code' => 'unique:mst_members,member_code',
                                    'name' => 'required'
                                ]);

        // Start Transaction
        DB::beginTransaction();

        // Store member's personal details
        $memberData = ['name'=>$request->name,
        'DOB'=> $request->DOB,
        'gender'=> $request->gender,
        'contact'=> $request->contact,
        'emergency_contact'=> $request->emergency_contact,
        'health_issues'=> $request->health_issues,
        'email'=> $request->email,
        'address'=> $request->address,
        'member_id'=> $request->member_id,
        'proof_name'=> $request->proof_name,
        'member_code'=> $request->member_code,
        'status'=> $request->status,
        'pin_code'=> $request->pin_code,
        'occupation'=> $request->occupation,
        'aim'=> $request->aim,
        'source'=> $request->source, ];


$member = new Member($memberData);
$member->createdBy()->associate(auth()->user());
$member->updatedBy()->associate(auth()->user());
$member->save();
$member_detail = new MemberDetail;
$member_detail->member_id = $member->id;
// Adding media i.e. Profile & proof photo
if ($request->hasFile('photo')) {

$file = $request->file('photo');
$file->move(public_path(). '/media/member',$file->getClientOriginalName());
$member_detail->image  = $file->getClientOriginalName();


}

if ($request->hasFile('proof_photo')) {

$file = $request->file('proof_photo');
$file->move(public_path(). '/media/member',$file->getClientOriginalName());
$member_detail->proof_image  = $file->getClientOriginalName();
}

$member_detail->save();
// return $member_detail;


// Helper function for calculating payment status
$invoice_total = $request->admission_amount + $request->subscription_amount + $request->taxes_amount - $request->discount_amount;
$paymentStatus = \constPaymentStatus::Unpaid;
$pending = $invoice_total - $request->payment_amount;

if ($request->mode == 1) {
if ($request->payment_amount == $invoice_total) {
$paymentStatus = \constPaymentStatus::Paid;
} elseif ($request->payment_amount > 0 && $request->payment_amount < $invoice_total) {
$paymentStatus = \constPaymentStatus::Partial;
} elseif ($request->payment_amount == 0) {
$paymentStatus = \constPaymentStatus::Unpaid;
} else {
$paymentStatus = \constPaymentStatus::Overpaid;
}
}


// Storing Invoice
$invoiceData = ['invoice_number'=> $request->invoice_number,
         'member_id'=> $member->id,
         'total'=> $invoice_total,
         'status'=> $paymentStatus,
         'pending_amount'=> $pending,
         'discount_amount'=> $request->discount_amount,
         'discount_percent'=> $request->discount_percent,
         'discount_note'=> $request->discount_note,
         'tax'=> $request->taxes_amount,
         'additional_fees'=> $request->additional_fees,
         'note'=>' ', ];

$invoice = new Invoice($invoiceData);
$invoice->createdBy()->associate(auth()->user());
$invoice->updatedBy()->associate(auth()->user());
$invoice->save();


// Storing subscription
foreach ($request->plan as $plan) {
$subscriptionData = ['member_id'=> $member->id,
                'invoice_id'=> $invoice->id,
                'plan_id'=> $plan['id'],
                'start_date'=> $plan['start_date'],
                'end_date'=> $plan['end_date'],
                'status'=> \constSubscription::onGoing,
                'is_renewal'=>'0', ];

$subscription = new Subscription($subscriptionData);
$subscription->createdBy()->associate(auth()->user());
$subscription->updatedBy()->associate(auth()->user());
$subscription->save();

//Adding subscription to invoice(Invoice Details)
$detailsData = ['invoice_id'=> $invoice->id,
           'plan_id'=> $plan['id'],
           'item_amount'=> $plan['price'], ];

$invoiceDetails = new InvoiceDetail($detailsData);
$invoiceDetails->createdBy()->associate(auth()->user());
$invoiceDetails->updatedBy()->associate(auth()->user());
$invoiceDetails->save();
}



// Store Payment Details
$paymentData = ['invoice_id'=> $invoice->id,
         'payment_amount'=> $request->payment_amount,
         'mode'=> $request->mode,
         'note'=> ' ', ];

$paymentDetails = new PaymentDetail($paymentData);
$paymentDetails->createdBy()->associate(auth()->user());
$paymentDetails->updatedBy()->associate(auth()->user());
$paymentDetails->save();

if ($request->mode == 0) {
// Store Cheque Details
$chequeData = ['payment_id'=> $paymentDetails->id,
          'number'=> $request->number,
          'date'=> $request->date,
          'status'=> \constChequeStatus::Recieved, ];

$cheque_details = new ChequeDetail($chequeData);
$cheque_details->createdBy()->associate(auth()->user());
$cheque_details->updatedBy()->associate(auth()->user());
$cheque_details->save();
}


// On member transfer update enquiry Status
if ($request->has('transfer_id')) {
$enquiry = Enquiry::findOrFail($request->transfer_id);
$enquiry->status = \constEnquiryStatus::Member;
$enquiry->updatedBy()->associate(auth()->user());
$enquiry->save();
}

//Updating Numbering Counters
Setting::where('key', '=', 'invoice_last_number')->update(['value' => $request->invoiceCounter]);
Setting::where('key', '=', 'member_last_number')->update(['value' => $request->memberCounter]);
$sender_id = \Utilities::getSetting('sms_sender_id');
$gym_name = \Utilities::getSetting('gym_name');

//SMS Trigger
if ($invoice->status == \constPaymentStatus::Paid) {
$sms_trigger = SmsTrigger::where('alias', '=', 'member_admission_with_paid_invoice')->first();
$message = $sms_trigger->message;
$sms_text = sprintf($message, $member->name, $gym_name, $paymentDetails->payment_amount, $invoice->invoice_number);
$sms_status = $sms_trigger->status;
// dd($request->all());
\Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
// dd($request->all());
} elseif ($invoice->status == \constPaymentStatus::Partial) {
$sms_trigger = SmsTrigger::where('alias', '=', 'member_admission_with_partial_invoice')->first();
$message = $sms_trigger->message;
$sms_text = sprintf($message, $member->name, $gym_name, $paymentDetails->payment_amount, $invoice->invoice_number, $invoice->pending_amount);
$sms_status = $sms_trigger->status;
// dd($request->all());
\Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
} elseif ($invoice->status == \constPaymentStatus::Unpaid) {
if ($request->mode == 0) {
$sms_trigger = SmsTrigger::where('alias', '=', 'payment_with_cheque')->first();
$message = $sms_trigger->message;
$sms_text = sprintf($message, $member->name, $paymentDetails->payment_amount, $cheque_details->number, $invoice->invoice_number, $gym_name);
$sms_status = $sms_trigger->status;
// dd($request->all());
\Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
} else {
$sms_trigger = SmsTrigger::where('alias', '=', 'member_admission_with_unpaid_invoice')->first();
$message = $sms_trigger->message;
$sms_text = sprintf($message, $member->name, $gym_name, $invoice->pending_amount, $invoice->invoice_number);
$sms_status = $sms_trigger->status;

\Utilities::Sms($sender_id, $member->contact, $sms_text, $sms_status);
}
// dd($request->all());
}

// dd($request->all());

if ($subscription->start_date < $member->created_at) {
$member->created_at = $subscription->start_date;
$member->updated_at = $subscription->start_date;
$member->save();

$invoice->created_at = $subscription->start_date;
$invoice->updated_at = $subscription->start_date;
$invoice->save();

foreach ($invoice->invoiceDetails as $invoiceDetail) {
$invoiceDetail->created_at = $subscription->start_date;
$invoiceDetail->updated_at = $subscription->start_date;
$invoiceDetail->save();
}

$paymentDetails->created_at = $subscription->start_date;
$paymentDetails->updated_at = $subscription->start_date;
$paymentDetails->save();

$subscription->created_at = $subscription->start_date;
$subscription->updated_at = $subscription->start_date;
$subscription->save();
}

DB::commit();
flash()->success('Member was successfully created');
// return $member->id;
// // also add as a customer
$customer = new Customer;
$customer->name = $member->name;
$customer->email = $member->email;
$customer->password = Hash::make($member->pin_code);
$customer->phone = $member->contact;
$customer->address = $member->address;
$customer->member_id = $member->id;
$customer->save();
// // ends
return redirect(action('MembersController@show', ['id' => $member->id]));
    }

    //End of new Member

    // End of store method

    /**
     * Edit a created resource in storage.
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $member_number_mode = \Utilities::getSetting('member_number_mode');
        $member_code = $member->member_code;

        return view('members.edit', compact('member', 'member_number_mode', 'member_code'));
    }

    /**
     * Update an edited resource in storage.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        //  return $request->all();
        $member = Member::findOrFail($id);
        $member->update($request->all());

         $member_detail =  MemberDetail::where('member_id', $id)->first();

            // Adding media i.e. Profile & proof photo
            if ($request->hasFile('photo')) {

                 if($member_detail->image){
                        $image_path = public_path().'/media/member/'.$member_detail->image;
                        unlink($image_path);
                    }

                    $file = $request->file('photo');
                    $file->move(public_path(). '/media/member',$file->getClientOriginalName());
                    $member_image = $file->getClientOriginalName();
                    $member_detail->update(['image' => $member_image]);
            }

            if ($request->hasFile('proof_photo')) {
                
                if($member_detail->proof_photo){
                        $image_path = public_path().'/media/member/'.$member_detail->proof_image;
                        unlink($image_path);
                    }

                 $file = $request->file('proof_photo');
                  $file->move(public_path(). '/media/member',$file->getClientOriginalName());
                  $member_proof_image = $file->getClientOriginalName();
                 $member_detail->update(['proof_photo' => $member_proof_image]);
            }

        // if ($request->hasFile('photo')) {
        //     $member->clearMediaCollection('profile');
        //     $member->addMedia($request->file('photo'))->usingFileName('profile_'.$member->id.'.'.$request->photo->getClientOriginalExtension())->toCollection('profile');
        // }

        // if ($request->hasFile('proof_photo')) {
        //     $member->clearMediaCollection('proof');
        //     $member->addMedia($request->file('proof_photo'))->usingFileName('proof_'.$member->id.'.'.$request->proof_photo->getClientOriginalExtension())->toCollection('proof');
        // }

        $member->updatedBy()->associate(auth()->user());
        $member->save();

        flash()->success('Member details were successfully updated');

        return redirect(action('MembersController@show', ['id' => $member->id]));
    }

    /**
     * Archive a resource in storage.
     *
     * @return Response
     */
    public function archive($id, Request $request)
    {
        Subscription::where('member_id', $id)->delete();

        $invoices = Invoice::where('member_id', $id)->get();

        foreach ($invoices as $invoice) {
            InvoiceDetail::where('invoice_id', $invoice->id)->delete();
            $paymentDetails = PaymentDetail::where('invoice_id', $invoice->id)->get();

            foreach ($paymentDetails as $paymentDetail) {
                ChequeDetail::where('payment_id', $paymentDetail->id)->delete();
                $paymentDetail->delete();
            }

            $invoice->delete();
        }

        $member = Member::findOrFail($id);
        $member_detail =  MemberDetail::where('member_id', $id)->first();

            if($member_detail->image){
                $image_path = public_path().'/media/member/'.$member_detail->image;
                unlink($image_path);
            }

            if($member_detail->proof_photo){
                    $image_path = public_path().'/media/member/'.$member_detail->proof_image;
                    unlink($image_path);
            }

        $member->delete();
        $member_detail->delete();
          
        // $member->clearMediaCollection('profile');
        // $member->clearMediaCollection('proof');

        // $member->delete();
        // $member->delete();

        return redirect('members');
    }

    public function transfer($id, Request $request)
    {
        // For Tax calculation
        JavaScript::put([
            'taxes' => \Utilities::getSetting('taxes'),
            'gymieToday' => Carbon::today()->format('Y-m-d'),
            'servicesCount' => Service::count(),
        ]);

        //Get Numbering mode
        $invoice_number_mode = \Utilities::getSetting('invoice_number_mode');
        $member_number_mode = \Utilities::getSetting('member_number_mode');

        //Generating Invoice number
        if ($invoice_number_mode == \constNumberingMode::Auto) {
            $invoiceCounter = \Utilities::getSetting('invoice_last_number') + 1;
            $invoicePrefix = \Utilities::getSetting('invoice_prefix');
            $invoice_number = $invoicePrefix.$invoiceCounter;
        } else {
            $invoice_number = '';
            $invoiceCounter = '';
        }

        //Generating Member Counter
        if ($member_number_mode == \constNumberingMode::Auto) {
            $memberCounter = \Utilities::getSetting('member_last_number') + 1;
            $memberPrefix = \Utilities::getSetting('member_prefix');
            $member_code = $memberPrefix.$memberCounter;
        } else {
            $member_code = '';
            $memberCounter = '';
        }

        $enquiry = Enquiry::findOrFail($id);

        return view('members.transfer', compact('enquiry', 'invoice_number', 'invoiceCounter', 'member_code', 'memberCounter', 'member_number_mode', 'invoice_number_mode'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function drpPlaceholder(Request $request)
    {
        if ($request->has('drp_start') and $request->has('drp_end')) {
            return $request->drp_start.' - '.$request->drp_end;
        }

        return 'Select daterange filter';
    }
}