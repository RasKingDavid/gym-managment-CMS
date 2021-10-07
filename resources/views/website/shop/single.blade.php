@extends('layouts.frontEnd.app')

@section('content')
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-md-4 text-center">
                <img src="{{ asset('files/product_images'.'/'.$product->image) }}" alt="image-missing"> <br>
                <span>{{ $product->product_name }}</span> <br> <br>
               
                @if ($product->stock > 0)
                    <span class="bg-success p-1 rounded">In Stock</span> <br> <br>
                @else
                    <span class="bg-warning p-1 rounded">In Stock</span> <br> <br>
                @endif

                @if ($product->discount_price != 0)
                    <span><b>Price: </b><del> Br. {{ $product->sale_price }}</del></span> <br>
                    <span><b>Discount Price:</b> Br. {{ $product->discount_price }}</span> <br>
                @else
                    <span><b>Price:</b> Br. {{ $product->sale_price }}</span> <br>
                @endif
               
                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-warning btn-sm text-center mt-3"><i class="fa fa-cart-plus"></i> add to cart</a>
            </div>
            <div class="col-12 col-md-8">
                <p>
                   {{ $product->description }} 
                </p>
            </div>
        </div>
    </div>
@endsection