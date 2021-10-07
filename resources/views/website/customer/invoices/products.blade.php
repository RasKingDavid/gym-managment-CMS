@extends('website.customer.dashboard.layouts.layout')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h4 class="text-center">Invoice: #{{ str_pad($id,6,"0",STR_PAD_LEFT) }} Product List</h4>
                </div>

                <div class="col-12 col-md-12" style="margin-top: 2%">
                    <table class="table table-bordered">
                        <thead>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->price*$item->quantity }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Total: {{ $invoice->total }}/=</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection