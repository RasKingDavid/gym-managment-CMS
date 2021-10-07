@extends('layouts.frontEnd.app')

@section('content')
    <div class="container-fluid mt-5 mb-5">
        <div class="row mb-5">
            <div class="col-md-12">
                @foreach ($categories as $item)
                    <a href="{{ route('shop.product_by_category', $item->id) }}" class="btn btn-md btn-info rounded">{{ $item->category_name }}</a>
                @endforeach
            </div>
        </div>
        <div class="row">
            @foreach ($products as $item)
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <span>{{ $item->product_name }}</span>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('files/product_images'.'/'.$item->image) }}" alt="no-image">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($item->discount_price != 0)
                                        <span class="float-left"><b>Price: </b><del> Br. {{ $item->sale_price }}</del></span>
                                        <span class="float-right"><b>Price:</b> Br. {{ $item->discount_price }}</span>
                                    @else
                                        <span class="float-left"><b>Price:</b> Br. {{ $item->sale_price }}</span>
                                    @endif
                                    
                                </div>
                                <div class="col-md-12 mt-2">
                                    <a href="{{ route('cart.add', $item->id) }}" class="btn btn-warning btn-sm float-left"><i class="fa fa-cart-plus"></i> add to cart</a>
                                    <a href="{{ route('shop.single_product', $item->id) }}" class="btn btn-success btn-sm float-right"><i class="fa fa-archive"></i> view details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection