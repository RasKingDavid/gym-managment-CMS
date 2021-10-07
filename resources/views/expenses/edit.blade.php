@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20 pull-left"><h4>update expense detail </h4></div>
                            <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary pull-right" style="color: #fff"> back</a>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($expense, ['method' => 'POST','action' => ['ExpensesController@update',$expense->id], 'id' => 'expensesform']) !!}

                            @include('expenses.form',['submitButtonText' => 'Update'])

                            {!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/expense.js') }}" type="text/javascript"></script>
@stop