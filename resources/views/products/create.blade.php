@extends('layouts.dashboard')

@section('title', 'Create Product')

@section('content')
    @include('includes.flash-message')
    <div class="col-12">
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
    </div>
    <div class="col-12">
        <form method="post" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-row">
                    <div class="col-6">
                        <label for="exampleInputEmail1">Name EN</label>
                        <input type="text" name="name_en" class="form-control" id="exampleInputEmail1"
                            placeholder="Name En" value="{{old('name_en')}}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail12">Name AR</label>
                        <input type="text" name="name_ar" class="form-control" id="exampleInputEmail12"
                            placeholder="Name Ar" value="{{old('name_ar')}}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="exampleInputEmail13">Price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail13"
                            placeholder="Price"  value="{{old('price')}}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail14">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="exampleInputEmail14"
                            placeholder="Quantity" value="{{old('quantity')}}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="exampleInputEmail15">Description EN</label>
                        <textarea name="desc_en" id="exampleInputEmail15" cols="30" rows="10"
                            class="form-control">{{old('desc_en')}}</textarea>
                        @error('desc_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail16">Description AR</label>
                        <textarea name="desc_ar" id="exampleInputEmail16" cols="30" rows="10"
                            class="form-control">{{old('desc_ar')}}</textarea>
                        @error('desc_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="exampleInputEmail17">Status</label>
                        <select name="status" class="form-control" id="exampleInputEmail17">
                            <option {{old('status') == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{old('status') == 0 ? 'selected' : ''}}  value="0">Not Active</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="exampleInputEmail18">Brand</label>
                        <select name="brand_id" class="form-control" id="exampleInputEmail18">
                            @foreach ($brands as $brand)
                                <option {{old('brand_id') == $brand->id ? 'selected' : ''  }} value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="exampleInputEmail19">Subcategory</label>
                        <select name="subcategory_id" class="form-control" id="exampleInputEmail19">
                            @foreach ($subcategories as $sub)
                                <option {{old('subcategory_id') == $sub->id ? 'selected' : ''  }} value="{{ $sub->id }}">{{ $sub->name_en }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
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
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="page" value="index">Create</button>
                <button type="submit" class="btn btn-dark"  name="page" value="back">Create & Return</button>
            </div>
        </form>
    </div>

@endsection
