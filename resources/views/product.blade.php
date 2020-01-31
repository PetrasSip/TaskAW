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

                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">REVIEWS</h2>
                    @if($product->reviews)
                        @foreach($product->reviews as $review)
                            {{$review->reviewer_name}}: {{$review->message}} <br /> <br />
                        @endforeach
                    @endif
                    <h2 class="card-title">ADD REVIEW</h2>
                    <div class="container">
                        <form method="POST" action="{{ route('addReview', ['id'=>$product->id]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="name" placeholder="Vartotojo vardas">
                            </div>
                            <label for="review" class="col-md-2 col-form-label">Product review</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="review" placeholder="ivedamas atsiliepimas apie preke">
                            </div>
                            <label for="rating" class="col-md-2 col-form-label">Product rating (1 to 5)</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="rating" placeholder="produkto ivertinimas (5-puikus; 1-šlamštas)">
                            </div>

                            <button type="submit" class="btn btn-outline-danger">Add review</button>
                        </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
