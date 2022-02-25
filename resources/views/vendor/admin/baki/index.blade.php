@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Name</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bakis as $baki)
                            <tr>
                                <td>{{ $baki->order_no }}</td>
                                <td>{{ $baki->name }}</td>
                                <td>{{ $baki->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection