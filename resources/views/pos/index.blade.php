@extends('app')

@section('header_scripts')
  
@endsection

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <div class="col-md-12">
                    <a href="{{ route('pos.create') }}" class="btn btn-primary btn-md"><i class="fa fa-plus-circle    "> Create New</i></a>
                </div>

                <div class="col-md-12">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <th>Invoice Number#</th>
                            <th>Sold By</th>
                            <th>Customer Name</th>
                            <th>Customer Phone</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->seller->name }}</td>
                                    <td>{{ $invoice->customer->name }}</td>
                                    <td>{{ $invoice->customer->phone }}</td>
                                    <td>{{ $invoice->total_amount }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y h:m a') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('pos.print',$invoice->id) }}" class="btn btn-success btn-md"><i class="fa fa-print    "></i></a>
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
@endsection
