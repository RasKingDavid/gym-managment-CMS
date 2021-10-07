@extends('app')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group col-md-6">
                                <label for="">Category Name:</label>
                                <input type="text" name="category_name" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Brand Name:</label>
                                <input type="text" name="brand_name" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-md btn-success pull-right">add category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection