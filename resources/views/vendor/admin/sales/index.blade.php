@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-5 p-3">
                    <form action="{{ route('sales.export') }}" method="GET">
                        @csrf
                    <div class="form-group">
                        <input type="date" name="from_date" id="from_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="date" name="to_date" id="to_date" class="form-control">
                    </div>
                    
                    <input type="submit" class="btn btn-info float-right" id="export" value="Export">
                </form>
                <div class="form-group">
                    <button class="btn btn-primary" id="search"><i class="fa fa-search" aria-hidden="true"></i></button>
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
            $('#export').attr('disabled', true);
            $('#search').on('click', function() {
                var fromDate = $('#from_date').val();
                var toDate = $('#to_date').val();
                var date = fromDate.concat(toDate);
                if (from_date != null || to_date != null) {
                    $.ajax({
                        url: '/sales/{from_to_date}',
                        type: 'get',
                        data: {
                            date:date
                        },
                        success: function(data) {
                            $('#new').empty();
                        $('#error').empty();
                        if (data.status) {
                            $('#error').html(data.message);
                            $('#export').attr('disabled', true);
                        } else {
                            $('#export').attr('disabled', false);
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
                }
            });
        });
    </script>
@endsection
