@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="form-group">
                    <input type="date" name="" id="search_date" class="form-control">
                </div>
            </div>
            <div class="col-md-6 p-3">
                <div class="form-group">
                    <input type="text" id="search_order" class="form-control" placeholder="search by order no">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Product Name</th>
                            <th>Total</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody id="new"></tbody>
                </table>
                <h5 id="error" class="text-center text-danger"></h5>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#search_date').change(function() {
                var date = $(this).val();
                // ajax
                $.ajax({
                    url: '/sales/{date}',
                    type: 'get',
                    data: {
                        date: date,
                    },
                    success: function(data) {
                        $('#new').empty();
                        $('#error').empty();
                        if (data.status) {
                            $('#error').html(data.message);
                        } else {
                            // foreach data
                            $.each(data, function(index, value) {
                                $.each(value, function(index2, value2) {
                                    $('#new').append(
                                        '<tr>' +
                                        '<td>' + value2.order_no + '</td>' +
                                        '<td>' + value2.name + '</td>' +
                                        '<td>' + value2.phone + '</td>' +
                                        '<td>' + value2.product_name +
                                        '</td>' +
                                        '<td>' + value2.product_total +
                                        '</td>' +
                                        '<td>' + value2.order_time +
                                        '</td>' +
                                        '</tr>'
                                    );
                                });
                            });
                        }
                    }
                });
            });
            $('#search_order').change(function() {
                var date = $(this).val();
                // ajax
                $.ajax({
                    url: '/sales/{date}',
                    type: 'get',
                    data: {
                        date: date,
                    },
                    success: function(data) {
                        $('#new').empty();
                        $('#error').empty();
                        if (data.status) {
                            $('#error').html(data.message);
                        } else {
                            // foreach data
                            $.each(data, function(index, value) {
                                $.each(value, function(index2, value2) {
                                    $('#new').append(
                                        '<tr>' +
                                        '<td>' + value2.order_no + '</td>' +
                                        '<td>' + value2.name + '</td>' +
                                        '<td>' + value2.phone + '</td>' +
                                        '<td>' + value2.product_name +
                                        '</td>' +
                                        '<td>' + value2.product_total +
                                        '</td>' +
                                        '<td>' + value2.order_time +
                                        '</td>' +
                                        '</tr>'
                                    );
                                });
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
