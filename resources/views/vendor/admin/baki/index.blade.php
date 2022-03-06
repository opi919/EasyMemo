@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="col">
                <a href="{{ route('baki.add') }}" class="btn btn-primary">Add New</a>
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
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bakis as $baki)
                            <tr>
                                <td>{{ $baki->order_no }}</td>
                                <td>{{ $baki->customer_name }}</td>
                                <td>{{ $baki->customer_phone }}</td>
                                <td>{{ $baki->amount }}</td>
                                <td>
                                    <a href="{{ route('baki.setPaid',$baki->id) }}" class="btn btn-success">Set Paid</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bakis->links() }}
            </div>
        </div>
    </div>
@endsection