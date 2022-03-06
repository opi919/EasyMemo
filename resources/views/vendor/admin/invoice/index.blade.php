@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Tax</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select name="product" id="product" class="form-control">
                                    <option id="0" value="0">Select Product</option>
                                    @foreach ($products as $product)
                                        <option id="{{ $product->id }}" value="{{ $product->product_name }}">
                                            {{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td width="10%">
                                <input type="number" class="form-control" name="quantity" id="quantity">
                            </td>
                            <td>
                                <h5 id="price"></h5>
                            </td>
                            <td>
                                <h5 id="tax"></h5>
                            </td>
                            <td>
                                <button class="btn btn-success" id="add">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="row">
            <div class="col-12 p-2" style="background-color:#f5f5f5;">
                <div id="errorMsg" class="text-center">
                </div>
                <form action="{{ route('invoice.export_pdf',$order_id) }}" method="POST">
                    @csrf
                <div class="p-4">
                    <div class="text-center">
                        <h4>Receipt</h4>
                    </div>
                    <span class="mt-4"> Time : </span><span class="mt-4" id="time">
                        
                    </span>
                    <input type="hidden" id="input_time" name="input_time" value="">
                    <input type="hidden" id="input_date" name="input_date" value="">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 ">
                            <span id="">Date: <span id="date"></span></span>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>Order No: {{ $order_id }}</p>
                            <input type="hidden" value="{{ $order_id }}" name="input_order_id">
                        </div>
                    </div>
                    <div class="p-3">
                        <div class="form-group">
                            <label>Enter Customer Name</label>
                            <input class="form-control" type ="text" name="customer_name" required>
                        </div>
                        <div class="form-group">
                            <label>Enter Email</label>
                            <input class="form-control" type ="email" name="customer_email" required>
                        </div>
                        <div class="form-group">
                            <label>Enter Mobile Number</label>
                            <input class="form-control" type ="text" name="customer_phone" required>
                        </div>
                        <div class="form-group">
                            <label>Enter Address</label>
                            <input class="form-control" type ="text" name="customer_address" required>
                        </div>
                    </div>
                    <div class="row">
                        </span>
                        <table id="receipt_bill" class="table">
                            <thead>
                                <tr>
                                    <th> No.</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Tax(%)</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody id="new" class="text-center">

                            </tbody>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td class="text-right text-dark">
                                    <h6><strong>Total Tax:</strong></h6>
                                </td>
                                <td class="text-center text-dark">
                                    <h5><strong><span id="taxTotal"></strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td class="text-right text-dark">
                                    <h6><strong>Sub Total:</strong></h6>
                                </td>
                                <td class="text-center text-dark">
                                    <h5> <strong><span id="subTotal"></strong></h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <input type="submit" class="btn btn-success" style="float: right;" value="Print" name="action">
                    <input type="submit" class="btn btn-success mr-2" style="float: right;" value="Download" name="action">
                </div>
            </form>
            </div>
        
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            // disable button
            $('#add').prop('disabled', true);
            $('#product').change(function() {
                $('#add').prop('disabled', true);
                var id = $(this).find(':selected')[0].id;
                // console.log(id);
                if (id == 0) {
                    $('#price').text(0);
                    $('#tax').text(0);
                } else {
                    // console.log(id);
                    $.ajax({
                        url: '/invoice/getprice/{id}',
                        type: 'get',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#price').text(data.price);
                            $('#tax').text(data.tax);
                            // console.log(data);
                        }
                    });
                }
                setTimeout(function() {
                    $('#add').prop('disabled', false);
                }, 1000);
            });
            var count = 1;
            var subTotal = 0;
            var taxTotal = 0;
            $('#add').on('click', function() {
                var name = $('#product').val();
                var quantity = $('#quantity').val();
                var price = $('#price').text();
                var tax = $('#tax').text();
                // console.log(quantity);
                if (quantity <= 0) {
                    var erroMsg =
                        '<span class="alert alert-danger">Minimum quantity should be 1 or More than 1</span>';
                    $('#errorMsg').html(erroMsg).fadeOut(5000);
                } else if (name == 0) {
                    var erroMsg = '<span class="alert alert-danger">Please Select Product</span>';
                    $('#errorMsg').html(erroMsg).fadeOut(5000);
                } else {
                    BillFunction();
                }
                function BillFunction() {
                    taxAmount = (price * tax) / 100;
                    taxTotal+= taxAmount;
                    var total = (price * quantity);
                    var newRow = '<tr>' +
                        '<td>' + '<input type="hidden" value="'+count+'" name="count[]">' +count + '</td>' +
                        '<td>' + '<input type="hidden" value="'+name+'" name="name[]">'+name+ + '</td>' +
                        '<td>' + '<input type="hidden" value="'+quantity+'" name="quantity[]">' +quantity + '</td>' +
                        '<td>' + '<input type="number" style="display:none;" value="'+price+'" name="price[]">' + price + '</td>' +
                        '<td>' + '<input type="hidden" value="'+taxAmount+'" name="tax[]">' + taxAmount.toFixed(1) + '</td>' +
                        '<td id="total">' + '<input type="number" style="display:none;" value="'+total.toFixed()+'" name="total[]">' +total.toFixed() + '</td>' +
                        '</tr>';
                    $('#new').append(newRow);
                    subTotal +=total+taxAmount; 
                    $('#subTotal').text(subTotal.toFixed());
                    $('#taxTotal').text(taxTotal.toFixed());
                    count++;
                }
                $('#add').prop('disabled', true);
            })
        });
    </script>
    <script type="text/javascript">
        document.getElementById('date').innerHTML=moment().format('L');
        document.getElementById('input_date').value=moment().format('Y-MM-DD');
    function showTime(){
        // console.log(moment().format('LTS'));
        document.getElementById('time').innerHTML=moment().format('LTS');
        document.getElementById('input_time').value=moment().format('LTS');
    }
    setInterval(showTime,1000);
      </script>
@endsection
