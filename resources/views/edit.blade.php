@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.update', ['admin'=>$product->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="edit" class="col-md-2 col-form-label">Edit SKU</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="sku" value="{{$product->sku}}">
                    </div>
                <label for="edit" class="col-md-2 col-form-label">Edit product name</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="name" value="{{$product->name}}">
                    </div>
                <label for="edit" class="col-md-2 col-form-label">Edit product image</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="img" value="{{$product->img}}">
                    </div>
                <label for="edit" class="col-md-2 col-form-label">Edit product description</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="description" value="{{$product->description}}">
                    </div>
                <label for="edit" class="col-md-2 col-form-label">Edit product price</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="price" value="{{$product->price}}">
                    </div>
                <label for="edit" class="col-md-2 col-form-label">Edit product visibility</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="visible" value="{{$product->visible}}">
                    </div>
                <label for="edit" class="col-md-2 col-form-label">Edit product discount</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="discount" value="{{$product->discount}}">
                    </div>

            </div>
            <button type="submit" class="btn btn-outline-danger">Update</button>
        </form>
    </div>
@endsection
