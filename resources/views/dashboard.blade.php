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
                                <?php $count = 0; $inLine = 3; ?>
                                @foreach($products as $product)
                                    <?php if($count > $inLine) { $count = 0; ?>
                                        </div>
                                        <div class="card-group">
                                    <?php } else { $count ++; } ?>

                                    <div class="card" style="width:400px">
                                        <a href="{{ route('product', ['id'=>$product->id]) }}"><img class="card-img-top" src="{{ url ('storage/'.$product->img)}}" alt="Card image" style="width:100%"></a>
                                        <div class="card-body">
                                            <h4 class="card-title">{{$product->name}}</h4>
                                            <h6>{{$product->finalPrice()}}</h6>
                                            <p class="card-text">{{$product->description}}</p>
                                            <a href="{{ route('product', ['id'=>$product->id]) }}" class="btn btn-primary">Details</a>
                                        </div>
                                    </div>
                                @endforeach
                                <?php while($count < $inLine) { $count ++; ?>
                                    <div class="card" style="width:400px"></div>
                                <?php } ?>
                                </div>
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
