@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>
                    {{$lang->text('products')}}
                </h2>
            </div>
        </div>
        <div class="row products">
            @isset($products)
                @foreach($products as $index => $product)
                    <div class="card col-md-4 m-2" style="width: 18rem;">
                        <img class="card-img-top" src="{{asset($product->image)}}" alt="Card image cap" style="height: 100px;">
                        <div class="card-body">
                            <h5 class="card-title">{{$product -> name}}</h5>
                            <p class="card-text">Some quick example text to build on the{{$product->desc}}</p>
                            <a id="addToCart"
                               class="btn btn-primary"
                               onclick="AddToCart({{$product->id}},{{$product->price}})"
                            >{{$lang->text('add_cart')}}</a>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
@endsection
