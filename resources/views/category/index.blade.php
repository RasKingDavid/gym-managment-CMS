@extends('app')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('category.create') }}" class="btn btn-primary btn-lg pull-left" style="margin-bottom:2%"><i class="fa fa-plus-circle"></i>&nbsp;Add Category</a>
                </div>
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <div class="col-lg-12">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <th>No</th>
                            <th>Category</th>
                            <th>Brand Name</th>
                            <th>Related Products</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->brand_name }}</td>
                                    <td>
                                        <a href="{{ route('product.by_category', $item->id) }}" class="btn btn-success text-white"><i class="fa fa-link"></i> Related Products</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit',$item->id) }}" class="btn btn-md btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('category.destroy',$item->id) }}" class="btn btn-md btn-danger" onclick="return confirm('Are you sure to remove this category?');"><i class="fa fa-trash"></i></a>
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