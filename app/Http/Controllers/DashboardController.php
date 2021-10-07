<?php

namespace App\Http\Controllers;

use Auth;
use App\Member;
use App\SmsLog;
use JavaScript;
use App\Enquiry;
use App\Expense;
use App\Product;
use App\Setting;
use App\Followup;
use Carbon\Carbon;
use App\ShopInvoice;
use App\ChequeDetail;
use App\Subscription;
use App\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        JavaScript::put([
            'jsRegistraionsCount' => \Utilities::registrationsChat(),
            'jsMembersPerPlan' => \Utilities::membersPerPlan(),
        ]);

        $startDate = new Carbon(Setting::where('key', '=', 'financial_start')->pluck('value'));
            // dd(PaymentDetail::whereMonth('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->count());
            // $totalIncome = PaymentDetail::select(DB::raw("sum(payment_amount) as totalPayment"))->where('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->count();
        // dd($totalIncome = PaymentDetail::select(DB::raw("sum(payment_amount) as totalPayment"))->whereMonth('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->get());

        $expirings = Subscription::dashboardExpiring()->paginate(5);
        $expiringCount = $expirings->total();
        $allExpired = Subscription::dashboardExpired()->paginate(5);
        $expiredCount = $allExpired->total();
        $birthdays = Member::birthday()->get();
        $birthdayCount = $birthdays->count();
        $recents = Member::recent()->get();
        $recentCount = $recents->count();
        $enquiries = Enquiry::onlyLeads()->get();
        $reminders = Followup::reminders()->get();
        $reminderCount = $reminders->count();
        $dues = Expense::dueAlerts()->get();
        $outstandings = Expense::outstandingAlerts()->get();
        $smsRequestSetting = \Utilities::getSetting('sms_request');
        $smslogs = SmsLog::dashboardLogs()->get();
        $recievedCheques = ChequeDetail::where('status', \constChequeStatus::Recieved)->get();
        $recievedChequesCount = $recievedCheques->count();
        $depositedCheques = ChequeDetail::where('status', \constChequeStatus::Deposited)->get();
        $depositedChequesCount = $depositedCheques->count();
        $bouncedCheques = ChequeDetail::where('status', \constChequeStatus::Bounced)->get();
        $bouncedChequesCount = $bouncedCheques->count();
        $membersPerPlan = json_decode(\Utilities::membersPerPlan());
        $products = Product::latest()->take(10)->get();
        $newOrders = ShopInvoice::where('checked','no')->get();

        return view('dashboard.index', compact('expirings', 'allExpired', 'birthdays', 'recents', 'recentCount', 'enquiries', 'reminders', 'dues', 'outstandings', 'smsRequestSetting', 'smslogs', 'expiringCount', 'expiredCount', 'birthdayCount', 'reminderCount', 'recievedCheques', 'recievedChequesCount', 'depositedCheques', 'depositedChequesCount', 'bouncedCheques', 'bouncedChequesCount', 'membersPerPlan','products','newOrders'));
    }

    public function indexCharts()
    {
        JavaScript::put([
            'jsRegistraionsCount' => \Utilities::registrationsChat(),
            'jsMembersPerPlan' => \Utilities::membersPerPlan(),
        ]);

        $startDate = new Carbon(Setting::where('key', '=', 'financial_start')->pluck('value'));
            // dd(PaymentDetail::whereMonth('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->count());
            // $totalIncome = PaymentDetail::select(DB::raw("sum(payment_amount) as totalPayment"))->where('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->count();
        // dd($totalIncome = PaymentDetail::select(DB::raw("sum(payment_amount) as totalPayment"))->whereMonth('created_at', '=', $startDate->month)->whereYear('created_at', '=', $startDate->year)->get());

        $expirings = Subscription::dashboardExpiring()->paginate(5);
        $expiringCount = $expirings->total();
        $allExpired = Subscription::dashboardExpired()->paginate(5);
        $expiredCount = $allExpired->total();
        $birthdays = Member::birthday()->get();
        $birthdayCount = $birthdays->count();
        $recents = Member::recent()->get();
        $recentCount = $recents->count();
        $enquiries = Enquiry::onlyLeads()->get();
        $reminders = Followup::reminders()->get();
        $reminderCount = $reminders->count();
        $dues = Expense::dueAlerts()->get();
        $outstandings = Expense::outstandingAlerts()->get();
        $smsRequestSetting = \Utilities::getSetting('sms_request');
        $smslogs = SmsLog::dashboardLogs()->get();
        $recievedCheques = ChequeDetail::where('status', \constChequeStatus::Recieved)->get();
        $recievedChequesCount = $recievedCheques->count();
        $depositedCheques = ChequeDetail::where('status', \constChequeStatus::Deposited)->get();
        $depositedChequesCount = $depositedCheques->count();
        $bouncedCheques = ChequeDetail::where('status', \constChequeStatus::Bounced)->get();
        $bouncedChequesCount = $bouncedCheques->count();
        $membersPerPlan = json_decode(\Utilities::membersPerPlan());

        return view('dashboard.index_chart', compact('expirings', 'allExpired', 'birthdays', 'recents', 'recentCount', 'enquiries', 'reminders', 'dues', 'outstandings', 'smsRequestSetting', 'smslogs', 'expiringCount', 'expiredCount', 'birthdayCount', 'reminderCount', 'recievedCheques', 'recievedChequesCount', 'depositedCheques', 'depositedChequesCount', 'bouncedCheques', 'bouncedChequesCount', 'membersPerPlan'));
    }

    public function smsRequest(Request $request)
    {
        $contact = 9820461665;
        $sms_text = 'A request for '.$request->smsCount.' sms has came from '.\Utilities::getSetting('gym_name').' by '.Auth::user()->name;
        $sms_status = 1;
        \Utilities::Sms($contact, $sms_text, $sms_status);

        Setting::where('key', '=', 'sms_request')->update(['value' => 1]);

        flash()->success('Request has been successfully sent, a confirmation call will be made soon');

        return redirect('/dashboard');
    }
}
