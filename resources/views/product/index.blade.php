@extends('layouts.app')

@section('content')

    <div class="container">
       <div class="card card-main">
           <div class="row">
               <div class="col-md-6 title">
                   <h2>
                       {{$lang->text('products')}}
                   </h2>
               </div>
           </div>
           <div class="row products text-center">
               @isset($products)
                   @foreach($products as $index => $product)
                       <div class="card col m-2 p-3" style="width: 17rem;">
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
    </div>
@endsection
