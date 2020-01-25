@extends('layouts.app')

@section('content')
<div class="container">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add product</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <br>
            <h3>Products list</h3>
                <table>
                    <tr>
                        <th style="width:100px">Product ID</th>
                        <th style="width:100px">SKU</th>
                        <th style="width:120px">Name</th>
                        <th style="width:100px">Image</th>
                        <th style="width:100px">Quantity</th>
                        <th style="width:100px">Visible(on/off)</th>
                        <th style="width:100px">Price, Eur</th>
                        <th style="width:100px">Discount</th>
                        <th style="width:100px">Vat</th>
                        <th style="width:130px">Total price, Eur</th>
                        <th style="width:100px">Edit</th>
                        <th style="width:100px">Delete</th>

                    </tr>

                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}} </td>
                        <td>{{$product->sku}} </td>
                        <td>{{$product->name}} </td>
                        <td>{{$product->img}} </td>
                        <td>{{$product->quantity ? $product->quantity->value : 'kiekis nežinomas'}} </td>
                        <td>{{$product->visible ? 'matomas' : 'nematomas'}}
                        <a href="{{route('changeVisibility', ['id'=> $product->id])}}">change</a>
                        </td>
                        <td>{{$product->price}} </td>
                        <td>{{$product->discount ? $product->discount->value : 0}} </td>
                        <td>{{$vat}}% </td>
                        <td>{{$product->finalPrice()}} Eur </td>
                        <td>
{{--                            <a href="admin/{{$product->id}}/edit" class="btn btn-default">Edit</a>--}}
                            <a href="{{route('admin.edit',['admin' => $product->id])}}" class="btn btn-outline-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.destroy', ['admin'=>$product->id]) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            {{ $products->links() }}
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <br>
            <h3>Add new product</h3>
            <div class="container">
                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="edit" class="col-md-2 col-form-label">SKU</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="sku" placeholder="ivedamas SKU">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Product name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="name" placeholder="ivedamas prekes pavadinimas">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Product image</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="img" placeholder="ivedamas i public\storage ikeltos nuotraukos failo pavadinimas">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Product description</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="description" placeholder="ivedamas prekes aprasymas">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Product price</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="price" placeholder="ivedama kaina">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Discount</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="discount" placeholder="ivedama nuolaida">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Product visible(0 or 1)</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="visible" placeholder="0 - produktas nematomas;  1 - produktas matomas">
                            </div>
                        <label for="edit" class="col-md-2 col-form-label">Product quantity</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="quantity" placeholder="ivedamas kiekis">
                            </div>

                        <button type="submit" class="btn btn-outline-danger">Add product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
