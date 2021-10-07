@extends('app')
<?php $settings = Utilities::getSettings(); ?>
@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <div class="row"><!-- Main row -->
                <div class="col-lg-12"><!-- Main col -->
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Received On</th>
                            {{-- <th>Actions</th> --}}
                        </thead>

                        <tbody>
                            @foreach ($web_enquiries as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>{{ $item->message }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('d M Y m:s a') }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- / Main col -->
            </div><!-- / Main row -->
        </div><!-- / Container -->
    </div><!-- / Rightside -->
@stop
@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function () {
            gymie.markEnquiryAs();
        });
    </script>
    
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@stop
