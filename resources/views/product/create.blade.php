@extends('app')

@section('content')
<div class="rightside bg-grey-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('flash::message')
            </div>
            <div class="col-md-12">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group col-md-6">
                            <label for="">Category:</label>
                            <select name="category_id" class="form-control" required>
                                <option value="" selected disabled>choose a category...</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">SKU:</label>
                            <input type="text" name="sku" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Stock:</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Minimum Stock:</label>
                            <input type="number" name="min_stock" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Product Name:</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Image:</label>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Purchase Price:</label>
                            <input type="number" name="purchase_price" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Sale Price:</label>
                            <input type="number" name="sale_price" class="form-control" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Discount Price:</label>
                            <input type="number" name="discount_price" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-md btn-success pull-right">add product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection