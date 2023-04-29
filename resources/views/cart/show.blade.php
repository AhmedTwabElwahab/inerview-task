@extends('layouts.app')

@section('content')
    <div class="container">
       <div class="card card-main">
           <div class="row">
               <div class="col-md-8 cart">
                   <div class="title">
                       <div class="row">
                           <div class="col"><h4><b>{{$lang->text('cart')}}</b></h4></div>
                           <div class="col d-flex align-self-center text-right text-muted justify-content-end">{{count($Cart->items)}} Items</div>
                       </div>
                   </div>
                   <form class="form" id ='Create_Invoice' action="{{route('showInvoice')}}"
                         method="get"
                         enctype="multipart/form-data"></form>
                   @csrf
                   @isset($Cart)
                       @if($Cart->items->isEmpty() == SUCCESS)
                          <div class="empty-cart text-center">
                              <div class="img">
                                  <img  src="{{asset('images/cart/empty_cart.svg')}}" alt="empty-cart">
                              </div>
                              <h2>Your Cart is <span style="color: #0a53be">Empty</span></h2>
                              <a href="{{route('product.index')}}" class="btn btn-warning">
                                  Go to Shopping
                              </a>
                          </div>
                       @else
                           @foreach($Cart->items as $index => $item)
                               <div class="row border-top border-bottom product_row">
                                   <div class="row main align-items-center">
                                       <div class="col-2">
                                           <img class="img-fluid" src="{{asset($item->product->image)}}"  alt="product-img"/>
                                       </div>
                                       <div class="col">
                                           <div class="row text-muted">{{$item->product-> name}}</div>
                                           <div class="row">{{$item->product->desc}}</div>
                                       </div>
                                       <div class="col">
                                           <a class="increase{{$item->id}}" onclick="decrease({{$item->id}})">-</a>

                                           <input id="quantity{{$item->id}}"
                                                  class="input-hide"
                                                  name="quantity[]"
                                                  form="Create_Invoice"
                                                  type="number"
                                                  min="0"
                                                  value="{{$item->quantity}}"
                                                  style="width:15%;"
                                           />
                                           <input type="hidden"
                                                  name="items_id[]"
                                                  value="{{$item->id}}"
                                                  form="Create_Invoice"
                                           />

                                           <a class="increase{{$item->id}}" onclick="increase({{$item->id}})">+</a>
                                       </div>
                                       <div class="col d-flex justify-content-between">
                                           <div class="d-flex">
                                               <span>{{CURRENCY_SYMBOL}}</span>
                                               <div id="price{{$item->id}}">
                                                   {{$item->product->price}}
                                               </div>
                                           </div>
                                           <div class="d-flex">
                                               <span>{{CURRENCY_SYMBOL}}</span>
                                               <div id="total{{$item->id}}" class="total_row">
                                                   {{($item->product->price * $item->quantity)}}
                                               </div>
                                           </div>
                                           <div class="close">
                                               <form id="delete_form{{$item->id}}" action="{{route('CartItem.destroy',$item)}}" style="padding: 0" method="POST">
                                                   @csrf
                                                   <input type="hidden" name="_method" value="DELETE">
                                                   <a id="remove_row" onclick="remove_item_cart({{$item->id}})">
                                                       &#10005;
                                                   </a>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           @endforeach
                           <div class="back-to-shop">
                               <a href="{{route('product.index')}}">
                                   &leftarrow; <span class="text-muted">Back to shop</span>
                               </a>
                           </div>
                       @endif
                   @endisset

               </div>
               <div class="col-md-4 summary">
                   <div><h5><b>TOTAL CART</b></h5></div>
                   <hr>
                   <div class="row">
                       <div class="col" style="padding-left:0;">{{count($Cart->items)}} Items</div>
                       <div class="col text-right d-flex">
                           <span>{{CURRENCY_SYMBOL}}</span>
                           <div id="total_Cart">
                               0.00
                           </div>
                       </div>
                   </div>
                   @if($Cart->items->isEmpty() == FAILED)
                       <button form="Create_Invoice" type="submit" class="btn btn-warning mt-3" >
                           Proceed to checkout
                       </button>
                   @endif
               </div>
           </div>
       </div>
    </div>
@endsection
