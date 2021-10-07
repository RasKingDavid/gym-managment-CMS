@extends('app')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid" style="margin-top: 2%">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <!--<div class="col-md-12">-->
                <!--    <a href="{{ route('working-schedule.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Add new working schedule</a>-->
                <!--</div>-->
                <div class="col-md-12" style="margin-top: 10px">
                    <table class="table table-striped">
                        <thead class="bg-info">
                            <th class="text-center">Day</th>
                            <th class="text-center">Starts From</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $item)
                                <tr>
                                    <td class="text-center">{{ $item->day }}</td>
                                    <td class="text-center">{{ $item->time }}</td>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('working-schedule.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="{{ route('working-schedule.destroy', $item->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
