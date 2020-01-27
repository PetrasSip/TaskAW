@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>{{$product->name}}</h1>
                </div>
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
                                        <h2 class="card-title">{{$product->name}}</h2><br>
                                        <h3>price: {{$product->finalPrice()}} Eur</h3><br>
                                        <h5 class="card-text">SKU: {{$product->sku}}</h5>
                                        <h5 class="card-text">Product description: {{$product->description}}</h5>
                                        <br>
                                        <br>
                                        <h5>quantity:  ({{$product->quantity ? $product->quantity->value : 0}}) pcs</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card" style="width:400px">
                                    <div class="card-body">
                                        <h2 class="card-title">SPECIFICATIONS</h2>
                                        @if($product->specifications)
                                            @foreach($product->specifications as $specification)
                                                {{$specification->specification->name}}: {{$specification->specification_text}} <br />
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
