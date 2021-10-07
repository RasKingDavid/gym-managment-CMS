@extends('website.customer.dashboard.layouts.layout')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid" style="margin-top: 2%">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <div class="col-md-12" style="margin-top: 10px">
                    <table class="table table-striped">
                        <thead class="bg-info">
                            <th class="text-center">Day</th>
                            <th class="text-center">Starts From</th>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $item)
                                <tr>
                                    <td class="text-center">{{ $item->day }}</td>
                                    <td class="text-center">{{ $item->time }}</td>
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
