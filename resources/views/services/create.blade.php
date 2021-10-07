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
                            <div class="panel-head font-size-20" style="float: left"><h4>Add service details</h4> </div>
                            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm" style="float: right; color:#fff"> back</a>
                        </div>

                        {!! Form::Open(['url' => 'plans/services','id'=>'servicesform','files'=>'true']) !!}

                        @include('services.form',['submitButtonText' => 'Add'])

                        {!! Form::Close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/service.js') }}" type="text/javascript"></script>
@stop