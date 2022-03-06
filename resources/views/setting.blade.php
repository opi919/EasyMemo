@extends('admin::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white">Brand Details</div>
                <div class="card-body">
                    <div class="card-text">
                        <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Brand Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="brand_name" id="brand_name" value="{{ $user->brand_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Brand Logo<span class="text-danger">*</span></label>
                                <input type="file" class="" name="brand_logo" id="brand_logo" value="{{ $user->brand_logo }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="brand_email" id="brand_email" value="{{ $user->brand_email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="brand_address" id="brand_address" value="{{ $user->brand_address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Contact No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="brand_contact" id="brand_contact" value="{{ $user->brand_contact }}" required>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection