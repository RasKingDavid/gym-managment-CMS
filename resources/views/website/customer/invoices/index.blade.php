@extends('website.customer.dashboard.layouts.layout')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h4 class="text-center">{{ $customer->name }}'s shopping history</h4>
                </div>

                <div class="col-12 col-md-12" style="margin-top: 2%">
                    <table class="table table-bordered">
                        <thead>
                            <th>Invoice ID</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $item)
                                <tr>
                                    <td>{{ str_pad($item->id,6,"0",STR_PAD_LEFT) }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                    <td>
                                        @if ($item->checked == 'yes')
                                            <span class="bg-success">confirmed</span>
                                        @else
                                            <span class="bg-warning">pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.shopped_products', $item->id) }}" class="btn btn-success btn-sm"><i class="fa fa-list"></i> view items</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection