@extends('app')
<?php $settings = Utilities::getSettings(); ?>
@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            @include('flash::message')
            <div class="row"><!-- Main row -->
                <div class="col-lg-12"><!-- Main col -->
                    <table class="table table-striped">
                        <thead>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </thead>

                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->quantity }}</td> 
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->price*$item->quantity }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Total Amount ({{ $set_tax->value }}% tax inc.):</td>
                                <td>{{ $invoice->total }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($invoice->checked == 'no')
                        <a href="{{ route('order.confirm', $invoice->id) }}" class="btn btn-success btn-md pull-right" style="margin-left: 10px;"><i class="fa fa-check    "></i> Confirm Order</a>
                        <a href="{{ route('order.cancel', $invoice->id) }}" class="btn btn-danger btn-md pull-right" ><i class="fa fa-times    "></i> Cancel Order</a>
                    @endif
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
