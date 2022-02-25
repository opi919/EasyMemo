@extends('admin::layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Add New Product
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <form method="POST" action="{{ route('product.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="product">Product Name</label>
                                <input type="text" class="form-control @error('product_name')is-invalid @enderror" id="product" name="product_name" placeholder="Enter Product Name">
                              </div>
                              @error('product_name')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="text" class="form-control @error('price')is-invalid @enderror" id="price" name="price" placeholder="Enter Product price">
                              </div>
                              @error('price')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                            <div class="form-group">
                                <label for="tax">Tax</label>
                                <input type="text" class="form-control @error('tax')is-invalid @enderror" id="tax" name="tax" placeholder="Enter Tax Amount">
                              </div>
                              @error('price')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                              <input type="submit" value="Submit" class="btn btn-primary">
                        </form>
                    </div>
   
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->tax }}</td>
                        <td>
                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger" id="delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection