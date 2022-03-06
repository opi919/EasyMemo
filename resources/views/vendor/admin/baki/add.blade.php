@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Add New Item
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <form action="{{ route('baki.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Order No<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="order_no" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="customer_email" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_phone" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_address" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Amount<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="amount" value="" required>
                                </div>
                                <input type="submit" value="Add" class="btn btn-primary"> 
                            </form>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection