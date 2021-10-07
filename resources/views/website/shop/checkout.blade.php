@extends('layouts.frontEnd.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <h4 class="text-center" style="font-family: 'Kaushan Script', cursive;">Congratulations!</h4>
                <?php 
                    $invoice_number = str_pad($invoice->id,6,"0",STR_PAD_LEFT) 
                ?>
                <br>
                <h4 class="text-center" style="font-family: 'Kaushan Script', cursive;">Invoice Number: #{{ $invoice_number }}</h4>
            </div>
            <div class="col-12 col-md-12 col-lg-12 text-center">
                <img src="{{ asset('media/company_image/checkout.jpg') }}" class="img-fluid" alt="image-missing">
            </div>
            <div class="col-12 col-md-12 col-lg-12 text-center">
                <p>We have collected your order. Your order total amount is: </p>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Sub Total:</td>
                            <td class="text-right">{{ $invoice->total-$invoice->tax_amount}}</td>
                        </tr>
                        <tr>
                            <td>Tax ({{ $tax_amount->value }}):</td>
                            <td class="text-right">{{ $invoice->tax_amount}}</td>
                        </tr>
                        <tr>
                            <td>Grand Total:</td>
                            <td class="text-right">{{ $invoice->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4"></div>
            <div class="col-12 col-md-12 col-lg-12 text-center">
                <p>Soon you will get get a call from our shop. Please ready the amount in time of delivery. Have a healthy day, First Fit will be always your best gym partner.</p>
            </div>
        </div>
    </div>
@endsection