@extends('admin::layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('product.update',$product->id) }}">
        @csrf
        <div class="form-group">
            <label for="">Product Name</label>
            <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" placeholder="Enter Product Name">
        </div>
        <div class="form-group">
            <label for="">Product Price</label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
        </div>
        <div class="form-group">
            <label for="">Tax Amount</label>
            <input type="text" class="form-control" name="tax" value="{{ $product->tax }}">
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
</div>

@endsection 