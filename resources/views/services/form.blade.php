<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('name','Service Name') !!}
                {!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('description','Service Description') !!}
                {!! Form::text('description',null,['class'=>'form-control', 'id' => 'description']) !!}
            </div>
        </div>
    </div>

    <div class="col-sm-6">
            @if (isset($service))
            <div class="form-group">
                {!! Form::label('Service Themnail','Service Themnail') !!}
                {!! Form::file('service_thumbnail',null,['class'=>'form-control', 'id' => 'service_thumbnail']) !!}
            </div>
            <div class="col-sm-2">
            <img alt="profile Pic" class="pull-right" src="{{ asset('media/service/' .$service->service_thumbnail) }}" height="70" width="70">
        </div>

                @else
                <div class="form-group">
                {!! Form::label('Service Themnail','Service Themnail') !!}
                {!! Form::file('service_thumbnail',null,['class'=>'form-control', 'id' => 'service_thumbnail']) !!}
            </div>

            @endif
        </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary pull-right']) !!}
            </div>
        </div>
    </div>
</div>
                            