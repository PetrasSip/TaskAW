@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.update', ['admin'=>$product->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label">Edit product name</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="name" value="{{$product->name}}">
                    </div>
                <label for="img" class="col-md-2 col-form-label">Edit product image</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="img" value="{{$product->img}}">
                    </div>
                <label for="description" class="col-md-2 col-form-label">Edit product description</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="description" value="{{$product->description}}">
                    </div>
                <label for="price" class="col-md-2 col-form-label">Edit product price</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="price" value="{{$product->price}}">
                    </div>
                <label for="discount" class="col-md-2 col-form-label">Edit product discount</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="discount" value="{{$product->discount ? $product->discount->value : 0}}">
                    </div>
                <label for="discount" class="col-md-2 col-form-label">Edit product quantity</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="quantity" value="{{$product->quantity ? $product->quantity->value : 0}}">
                    </div>
                <label for="visible" class="col-md-2 col-form-label">Edit product visibility</label>
                    <div class="col-md-9">
                            <input class="form-control" type="text" name="visible" value="{{$product->visible}}">
                    </div>

            </div>
            <button type="submit" class="btn btn-outline-danger">Update</button>
        </form>

        <hr />

        @if($product->specifications)
            <h1>Specifications</h1>
            @foreach($product->specifications as $specification)
                {{$specification->specification->name}}: {{$specification->specification_text}} <a href="{{route('removeSpecification', ['pid' => $specification->product_id, 'sid' => $specification->specification_id])}}">Delete</a><br />
            @endforeach
        @endif
        <br>
        <br>
        <h3>Add new specification</h3>
        <div class="container">
            <form method="POST" action="{{ route('addNewSpecification') }}">
                @csrf
                <div class="form-group row">
                    <label for="specification" class="col-md-2 col-form-label">Specification</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="specification" placeholder="ivedamas specifikacija">
                    </div>

                    <button type="submit" class="btn btn-outline-danger">Create specification</button>
                </div>
            </form>
        </div>

        <h3>Attach Specification to product</h3>
        <form method="POST" action="{{ route('addSpecification', ['id' => $product->id]) }}">
            @csrf
            <label for="specification" class="col-md-2 col-form-label">Specification type</label>
            <div class="col-md-9">
                <select name="specification">
                    @foreach($specifications as $specification)
                        <option value="{{$specification->id}}">{{$specification->name}}</option>
                    @endforeach
                </select>
            </div>
            <label for="productSpecification" class="col-md-2 col-form-label">Attach Specification to product</label>
            <div class="col-md-9">
                <input type="text" name="productSpecification" />
            </div>
            <button type="submit" class="btn btn-outline-danger">Attach Specification to product</button>
        </form>
    </div>
@endsection
