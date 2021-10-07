@extends('app')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-lg pull-left" style="margin-bottom:2%"><i class="fa fa-plus-circle"></i>&nbsp;Add Product</a>
                </div>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <div class="col-lg-12">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <th>No</th>
                            <th>Category</th> 
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th>Stock</th>
                            <th>Minimum Stock</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach ($products as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category->category_name  }}</td>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ substr($item->description,0,300) }}....</td>
                                    <td>{{ $item->purchase_price }}</td>
                                    <td>{{ $item->sale_price }}</td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->min_stock }}</td>
                                    <td>
                                        <img src="{{ asset('files/product_images').'/'.$item->image }}" alt="image-missing">
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('product.destroy',$item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this product?');"><i class="fa fa-trash"></i></a>
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

@section('footer_script_init')
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@stop