@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white">Total Sales</div>
                <div class="card-body">
                    <div class="card-text">
                        <h1>Total Sales(Last 7 days): {{ $subTotal }}</h1>
                        <h1>Total Tax(Last 7 days): {{ $tax }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection