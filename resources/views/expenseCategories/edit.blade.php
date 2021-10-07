@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20 pull-left"> <h4> update expense category detail</h4></div>
                            <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary pull-right"> back</a>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($expenseCategory, ['method' => 'POST','action' => ['ExpenseCategoriesController@update',$expenseCategory->id], 'id' => 'expensecategoriesform']) !!}

                            @include('expenseCategories.form',['submitButtonText' => 'Update'])

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