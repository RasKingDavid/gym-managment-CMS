@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <!-- Error Log -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20 pull-left"><h4>add expense category detail </h4></div>
                            <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary pull-right" style="color: #fff"> back</a>
                        </div>
                        <div class="panel-body">
                            {!! Form::Open(['url' => 'expenses/categories', 'id' => 'expensecategoriesform']) !!}

                            @include('expenseCategories.form',['submitButtonText' => 'Add'])

                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/expenseCategory.js') }}" type="text/javascript"></script>
@stop