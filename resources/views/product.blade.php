@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>{{$product->name}}</h1></div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="width:400px">
                             <img class="card-img-top" src="{{ url ('storage/'.$product->img)}}" alt="Card image" style="width:100%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="width:400px">
                            <div class="card-body">
                                <h2 class="card-title">{{$product->name}}</h2>
                                <h3>price: {{$product->price}} Eur</h3>
                                <h5 class="card-text">Product description: {{$product->description}}</h5>
                                <br>
                                <br>
                                <br>
                                <h5>quantity:  ({{$product->quantity ? $product->quantity->value : 0}}) pcs</h5>
                                {{--                                            <a href="#" class="btn btn-primary">See Profile</a>--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
