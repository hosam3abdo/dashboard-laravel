@extends('layouts.dashboard')

@section('title', 'Edit Product')

@section('content')
    @include('includes.flash-message')
    <div class="col-12">
        <form method="post" enctype="multipart/form-data" action="{{route('dashboard.products.update',$product->id)}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-row">
                    <div class="col-6">
                        <label for="exampleInputEmail1">Name EN</label>
                        <input type="text" name="name_en" class="form-control" id="exampleInputEmail1" value="{{$product->name_en}}"
                            placeholder="Name En">
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail12">Name AR</label>
                        <input type="text" name="name_ar" class="form-control" id="exampleInputEmail12" value="{{$product->name_ar}}"
                            placeholder="Name Ar">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="exampleInputEmail13">Price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail13" placeholder="Price" value="{{$product->price}}"> 
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail14">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="exampleInputEmail14" value="{{$product->quantity}}"
                            placeholder="Quantity">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="exampleInputEmail15">Description EN</label>
                        <textarea name="desc_en" id="exampleInputEmail15" cols="30" rows="10" class="form-control">{{$product->desc_en}}</textarea>
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail16">Description AR</label>
                        <textarea name="desc_ar" id="exampleInputEmail16" cols="30" rows="10" class="form-control">{{$product->desc_ar}}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="exampleInputEmail17">Status</label>
                        <select name="status" class="form-control" id="exampleInputEmail17">
                            <option {{ $product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option  {{ $product->status == 0 ? 'selected' : ''}}  value="0">Not Active</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="exampleInputEmail18">Brand</label>
                        <select name="brand_id" class="form-control" id="exampleInputEmail18">
                            @foreach ($brands as $brand)
                                <option {{ $brand->id == $product->brand_id ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="exampleInputEmail19">Subcategory</label>
                        <select name="subcategory_id" class="form-control" id="exampleInputEmail19">
                            @foreach ($subcategories as $sub)
                                <option {{ $sub->id == $product->subcategory_id ? 'selected' : '' }} value="{{$sub->id}}">{{$sub->name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <img src="{{url('images/products/'.$product->image)}}" alt="{{$product->name_en}}" class="w-100">
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning" name="page" value="index">Update</button>
                <button type="submit" class="btn btn-dark"  name="page" value="back">Update & Return</button>
            </div>
        </form>
    </div>

@endsection
