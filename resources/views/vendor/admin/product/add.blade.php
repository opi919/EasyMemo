@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Add New Product
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                <form action="{{ route('product.store') }}" method="POST">
                                    @csrf
                    <div class="form-group">
                        <label for="">Product Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="product_name" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Price<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="product_price" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tax<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="product_tax" value="" required>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection