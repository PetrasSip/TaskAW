@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.update', ['admin'=>$product->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="edit" class="col-md-2 col-form-label">Edit product name</label>

                <div class="col-md-9">
                    <input class="form-control" type="text" value="{{$product->name}}">
                    <button type="submit" class="btn btn-outline-danger">Update</button>

                </div>
            </div>


        </form>

    </div>
@endsection
