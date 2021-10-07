@extends('app')

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('working-schedule.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Add new working schedule</a>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <th class="text-center">Member Code</th>
                            <th class="text-center">Member Name</th>
                            <th class="text-center">Member Contact</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($members as $item)
                                <tr>
                                    <td class="text-center">{{ $item->member_code }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->contact }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('working-schedule.show', $item->id) }}" class="btn btn-success btn-sm"><i class="fa fa-clock-o" aria-hidden="true"></i> view working schedule</a>
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

@section('footer_script_init')
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@stop