@extends('app')

@section('header_scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="rightside bg-grey-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
                <div class="col-md-6">
                    <form action="{{ route('pos.store') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="form-row">
                            <div id="client" class="col-md-6 form-group">
                                <label for="">Customer:</label>
                                <select name="customer_id" class="select2 form-control" required>
                                    <option></option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Invoice Number: </label>
                                    <input type="text" name="invoice_number" class="form-control text-center" readonly
                                        value="{{ uniqid() }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <table id="sale" class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity sold</th>
                                            <th>Unit Price</th>
                                            <th>TotalPrice</th>
                                            <th style="width: 25px;">Delete</th>
                                        </tr>
                                    </thead>
            
                                    <tbody class="order-list">
            
                                    </tbody>
                                    <tfoot>
            
                                    </tfoot>
            
                                </table>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Sub Total : </label>
                                            <input type="number" name="sub_total" class="form-control  col-sm-6 total-price" min="0"
                                                readonly value="0" style="border-color: black;border-radius:10px;" id="sub-total">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Discount : </label>
                                            <input type="number" id="discount" name="discount"
                                                class="form-control col-sm-6 discount" min="0" value="0" style="border-color: black;border-radius:10px;">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Total Amount :  </label>
                                            <input type="number" id="total-amount" name="total_amount"
                                                class="form-control col-sm-6 total-amount" readonly min="0" value="0" style="border-color: black; border-radius:10px;">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Tax:  </label>
                                            <input type="text" id="tax-amount" name="tax"
                                                class="form-control col-sm-6" readonly value="0" style="border-color: black; border-radius:10px;">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Grand Total:  </label>
                                            <input type="number" id="grand-total" name="grand_total"
                                                class="form-control col-sm-6" readonly min="0" value="0" style="border-color: black; border-radius:10px;">
                                        </div>
                                        <div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Payment Method :  </label>
                                                <select id="select" class="form-control col-sm-6" name="payment_method" style="border-color: black !important; border-radius:10px;">
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Mobile-Banking">Mobile-Banking</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Paid : </label>
                                                <input id="paid" type="number" name="paid" class="form-control col-sm-6 paid"
                                                    value="0" style="border-color: black;border-radius:10px;">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Change : </label>
                                                <input id="change" type="number" name="change_amount" readonly class="form-control col-sm-6 paid"
                                                    value="0" style="border-color: black;border-radius:10px;">
                                            </div>
                                        </div>
                                        <div>
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Due : </label>
                                                <input id="due" type="number" name="due" class="form-control col-sm-6"
                                                    readonly value="0" style="border-color: black; border-radius:10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-md pull-right">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- Product Image --}}
                <div class="col-md-6">
                    {{-- <div id="pds" class="row text-center text-lg-left containerItems"> --}}
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <th>Product Name</th>
                                <th>Product SKU</th>
                                <th>Image</th>
                                <th>Action</th>
                            </thead>
                            <tbody class="product-table">
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>
                                            <img class="img-fluid" src="{{ asset('files/product_images').'/'.$product->image }}" alt="">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" data-tooltip="tooltip"
                                                title="Price : {{ $product->sale_price }} stock : {{ $product->stock }}"
                                                data-placement="top" id="product-{{ $product->id }}" +
                                                data-name="{{ $product->product_name }}" + data-id="{{ $product->id }}" +
                                                data-price="{{ $product->sale_price }}" + data-stock="{{ $product->stock }}" class="btn btn-primary  btn-sm con d-block mb-4 add-product-btn"><i class="fa fa-cart-plus"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script_init')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {

            // Add product to sale 
            $('.add-product-btn').on('click', function (e) {
                e.preventDefault();
                var stock = $(this).data('stock');
                if (stock == 0) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        type: 'error',
                        title: 'You Product Stock is Empty !! Please Update It'
                    });
                    // Swal('Oops...', 'You Product Stock is Empty !! Please Update It', 'error')
                } else {
                    e.preventDefault();
                    var name = $(this).data('name');
                    var id = $(this).data('id');
                    var price = $(this).data('price');
                    var unit_price = $(this).data('price');
                    // alert(price);
                    numRows = $('.order-list .items').length + 1;
                    //var qty = $('#qty').val();
                    for (var i = 1; i < numRows; i++) {
                        var code = $(".order-list tr:nth-child(" + i + ") td:nth-child(1)").html();
                        var next = $(".order-list tr:nth-child(" + i + ") td:nth-child(3) input").val();
                        if (code == name) {
                            var add = parseInt(next) + 1;
                            if (add <= stock) {
                                $(".order-list tr:nth-child(" + i + ") td:nth-child(3) input").val(add);
                                var all = add * price;

                            }
                            $(".order-list tr:nth-child(" + i + ") td:nth-child(5)").html(all);
                            calculateTotal();
                            calculateTotalAmount();
                            return true;
                        }

                    }
                    var html =
                        `<tr id="${id}" class="form-group items">
                        <td id="name" class="namex">${name}</td>
                        <input type="hidden" name="product_id[]" value="${id}">
                        <td style="display: flex;">        
                        <input id="qty"  type="text" name="quantity[]" data-price="${price}" data-stock="${stock}" class="form-control input-sm product-quantity" min="1" max="${stock}" value="1" readonly>
                        </td>
                        <td class="unit-price">${unit_price}</td>
                        <td class="product-price">${price}</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
                    </tr>`;
                    $('.order-list').append(html);
                    calculateTotal();
                    calculateTotalAmount();
                    
                    return true;
                }


            });

            //to calculate total price

            $('body').on('click', '.disabled', function (e) {

                e.preventDefault();

            }); //end of disabled

            $('body').on('click', '.remove-product-btn', function (e) {

                e.preventDefault();
                var id = $(this).data('id');

                $(this).closest('tr').remove();
                //$('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

                //to calculate total price
                calculateTotal();
                calculateTotalAmount();
                

            }); //end of remove product btn

            $('body').on('keyup focus', '.product-quantity', function (e) {

                var quantity = parseInt($(this).val()); //2
                var unitPrice = $(this).data('price'); //150

                $(this).closest('tr').find('.product-price').html(quantity * unitPrice);
                calculateTotal();
                calculateTotalAmount();
                

            }); //end of product quantity change

           

            $('body').on('keyup focus', '.paid', function () {

                
                var totalamount = $('#total-amount').val();
                var paid = $('#paid').val();
                if (paid == 0) {
                    $('#select option[value="nopaid"]').prop('selected', true);
                } else if (totalamount == paid) {
                    $('#select option[value="paid"]').prop('selected', true);
                } else {
                    $('#select option[value="debt"]').prop('selected', true);
                }

            });
            $('body').on('change', '.paid', function () {
                $('#select option[value="debt"]').prop('selected', true);

            });
        }); //end of document ready

        function calculateTotal() {

        var price = 0;

            $('.order-list .product-price').each(function (index) {

                price += parseInt($(this).html());

            }); //end of product price

            //$('.total-price').html(price);
            $('.total-price').val(price);

        } //end of calculate total
        function calculateTotalAmount() {

            var total = $('.total-price').val();
            var discount = $('#discount').val();
            var total_amount = total - discount;
            $('#total-amount').val(total_amount);
            $("#tax-amount").val(Math.floor(total_amount*({{ $set_tax->value }}/100)));
            $("#grand-total").val(total_amount+Math.floor(total_amount*({{ $set_tax->value }}/100)));
            $('#paid').val(total_amount+Math.floor(total_amount*({{ $set_tax->value }}/100)));

        } //end of calculate total Amount
        
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select customer...",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#paid").on("input",function(){
                var total_amount = $("#grand-total").val();
                var paid_amount = this.value;
                var due_amount = $("#due").val()

                if(paid_amount > total_amount){
                    if(paid_amount - total_amount < 0){
                        $("#change").val(0);
                    }else{
                        $("#change").val(paid_amount-total_amount);
                        $("#due").val(0);
                    }
                    
                }else{
                    if(total_amount-paid_amount >= 0){
                        $("#due").val(total_amount-paid_amount);
                    }else{
                        $("#due").val(0);
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#discount").on("input",function(){
                var total_amount = $("#sub-total").val();
                var discount = $('#discount').val();
                total_amount = total_amount-discount;
                $('#total-amount').val(total_amount);
                $("#tax-amount").val(Math.floor(total_amount*({{ $set_tax->value }}/100)));
                $("#grand-total").val(total_amount+Math.floor(total_amount*({{ $set_tax->value }}/100)));
                $('#paid').val(total_amount+Math.floor(total_amount*({{ $set_tax->value }}/100)));
            });
        });
    </script>
@endsection
