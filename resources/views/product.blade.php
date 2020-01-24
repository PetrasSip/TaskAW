@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>{{$product->name}}</h1></div>
{{--                <div class="card-header"><h1>dfdsfgsdg</h1></div>--}}
                <div class="card-body">
                    <div class="row">
                        <div class="container">
                            <div class="card-group">


                                    <div class="card" style="width:400px">
{{--                                        <img class="card-img-top" src="{{ url ('storage/'.$product->img)}}" alt="Card image" style="width:100%">--}}
                                        <img class="card-img-top" src="" alt="Card image" style="width:100%">
                                        <div class="card-body">
{{--                                            <h4 class="card-title">{{$product->name}}</h4>--}}
                                            <h4 class="card-title">sdffgjhj</h4>
{{--                                            <h6>{{$product->price}}</h6>--}}
                                            <h6>sdfgdjgfhkj</h6>
{{--                                            <p class="card-text">{{$product->description}}</p>--}}
                                            <p class="card-text">hjlkhjklhjkl</p>
                                            <a href="#" class="btn btn-primary">See Profile</a>
                                        </div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
