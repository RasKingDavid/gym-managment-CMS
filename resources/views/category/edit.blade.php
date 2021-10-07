@extends('app')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <div class="col-md-12">
                    <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group col-md-6">
                                <label for="">Category Name:</label>
                                <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Brand Name:</label>
                                <input type="text" name="brand_name" class="form-control" value="{{ $category->brand_name }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-md btn-success pull-right">update category</button>
                            </div>
                        </div>
                    </form>
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