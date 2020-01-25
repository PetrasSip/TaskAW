@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>PRODUCTS</h1></div>
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="card-group">

                                @foreach($products as $product)
                                    <div class="card" style="width:400px">
                                        <a href="{{ route('product', ['id'=>$product->id]) }}"><img class="card-img-top" src="{{ url ('storage/'.$product->img)}}" alt="Card image" style="width:100%"></a>
                                        <div class="card-body">
                                            <h4 class="card-title">{{$product->name}}</h4>
                                            <h6>{{$product->price}}</h6>
                                            <p class="card-text">{{$product->description}}</p>
                                            <a href="#" class="btn btn-primary">See Profile</a>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
