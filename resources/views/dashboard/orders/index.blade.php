@extends('app')
<?php $settings = Utilities::getSettings(); ?>
@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <div class="row"><!-- Main row -->
                <div class="col-lg-12"><!-- Main col -->
                    @include('flash::message')
                    <h4 class="text-center text-info">New Orders</h4>
                    <table class="table table-striped">
                        <thead>
                            <th>Customer</th>
                            <th>Contact Number</th>
                            <th>total</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach ($newOrders as $order)
                                <tr>
                                    <td>{{ $order->buyer->name }}</td>
                                    <td>{{ $order->buyer->phone }}</td>
                                    <td>{{ $order->total }}</td> 
                                    <td>
                                        <a href="{{ route('order.products', $order->id) }}" class="btn btn-success btn-md"><i class="fa fa-eye    "></i> view products</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- / Main col -->
                <div class="col-lg-12"><!-- Main col -->
                    <h4 class="text-center">All Orders</h4>
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <th>Customer</th>
                            <th>Contact Number</th>
                            <th>total</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach ($allOrders as $order)
                                <tr>
                                    <td>{{ $order->buyer->name }}</td>
                                    <td>{{ $order->buyer->phone }}</td>
                                    <td>{{ $order->total }}</td> 
                                    <td>
                                        <a href="{{ route('order.invoice.print', $order->id) }}" class="btn btn-success btn-md"><i class="fa fa-print    "></i></a>
                                    </td>
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
