@extends('website.customer.dashboard.layouts.layout')

@section('content')
    <div class="rightside bg-grey-100">
        @if ($is_member)
            <div class="container">
                <div class="row margin-top-10 align-items-stretch">
                    <div class="c-dashboardInfo col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="wrap">
                            <table class="table table-striped">
                                <thead>
                                    <th class="text-center">Subscription Started</th>
                                    <th class="text-center">Subscription Ends</th>
                                    <th class="text-center">On Auto renewal</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y h:m') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y h:m') }}</td>
                                        @if($subscription->is_renewal == 0)
                                            <td class="bg-warning">No</td>
                                        @else
                                            <td class="bg-success">Yes</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    <div class="c-dashboardInfo col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="wrap">
                            @if($subscription->is_renewal == 0)
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                    No upcoming payments as your subscription is not on renewal.
                                </h4>
                                <span class="hind-font caption-12 c-dashboardInfo__count">
                                    <div class="font-roboto " data-toggle="counter" data-start="0" data-from="0"
                                        data-to="" data-speed="500" data-refresh-interval="10">
                                    </div>
                                </span>
                                <span
                                    class="hind-font caption-12 c-dashboardInfo__subInfo">
                                        Upcoming Payments (Still not done yet!)
                                </span>
                            @else
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                    @if($subStatus == true)
                                        Your subscription has been expired.
                                    @else
                                        Please renew your subscription within - {{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}
                                    @endif
                                </h4>
                                <span class="hind-font caption-12 c-dashboardInfo__count">
                                    @if($subStatus == true)
                                        Contact First-Fit for subscriptional details.
                                    @else
                                        <div class="font-roboto " data-toggle="counter" data-start="0" data-from="0"
                                            data-to="{{ $subInvoice->total }}" data-speed="500" data-refresh-interval="10">
                                        </div>
                                        <span
                                            class="hind-font caption-12 c-dashboardInfo__subInfo">
                                                Upcoming Payments (Still not done yet!)
                                        </span>
                                    @endif
                                   
                                </span>
    
                            @endif
                        </div>
                    </div> 
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom:2%">
                        <h4 class="text-center">Customer Invoices</h4>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <th>Invoice Number</th>
                                <th>Total Amount</th>
                                <th>Pending</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Date</th>
                                {{-- <th>Action</th> --}}
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->total}}</td>
                                        <td>{{ $invoice->pending_amount}}</td>
                                        <td>{{ $invoice->discount_amount}}</td>
                                        <td>
                                            <span class="{{ Utilities::getInvoiceLabel ($invoice->status) }}">{{ Utilities::getInvoiceStatus ($invoice->status) }}</span>
                                        </td>
                                        <td>{{ $invoice->created_at->toDayDateTimeString()}}</td>
                                        {{-- <td>
                                            <a href="{{  }}" class="btn btn-success btn-md">
                                                View invoice
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection