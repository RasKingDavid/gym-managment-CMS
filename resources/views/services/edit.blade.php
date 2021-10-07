@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                         <div class="panel-title">
                            <div class="panel-head font-size-20" style="float: left"><h4>update service details</h4> </div>
                            <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm" style="float: right; color:#fff"> back</a>
                        </div>

                        {!! Form::model($service, ['method' => 'POST','action' => ['ServicesController@update',$service->id],'id'=>'servicesform', 'files'=>'true']) !!}

                        @include('services.form',['submitButtonText' => 'Update'])

                        {!! Form::Close() !!}

                        </form>

                    </div>
                </div>
            </div>
        </div>

        @stop
        @section('footer_scripts')
            <script src="{{ URL::asset('assets/js/service.js') }}" type="text/javascript"></script>
@stop