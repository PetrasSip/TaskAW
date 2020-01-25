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
                        <td>Quantity </td>
                        <td>Visible(on/off) </td>
                        <td>{{$product->price}} </td>
                        <td>Discount </td>
                        <td>Vat </td>
                        <td>Total price, Eur </td>
                        <td>
{{--                            <a href="admin/{{$product->id}}/edit" class="btn btn-default">Edit</a>--}}
                            <a href="{{route('admin.edit',['admin' => $product->id])}}" class="btn btn-default">Edit</a>
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
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Antras</div>

    </div>

</div>

@endsection
