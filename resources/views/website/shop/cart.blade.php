@extends('layouts.frontEnd.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <h4 class="text-center">Your Shopping Cart</h4>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <th>Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Total Price</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">{{ $item->price }}</td>
                                <td class="text-center">{{ $item->price*$item->quantity }}</td>
                                <td class="text-center">
                                    <a href="{{ route('cart.increase',$item->id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i></a>
                                    <a href="{{ route('cart.remove',$item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Sub Total:</td>
                            <td> {{ $total }}/=</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Tax Amount:</td>
                            <td>{{ $total*($tax_amount->value/100) }}/=</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Total</td>
                            <td>{{ $total+$total*($tax_amount->value/100) }}/=</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('cart.checkout') }}" class="btn btn-md btn-success rounded float-right"><i class="fa fa-arrow-right"></i> Place Order</a>
            </div>
        </div>
    </div>
@endsection