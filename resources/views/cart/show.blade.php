@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>
                    {{$lang->text('cart')}}
                </h3>
            </div>
        </div>

        <table class="table table-light text-center" id="Cart">
            <thead>
            <tr>
                <th>{{$lang->text('image')}}</th>
                <th>{{$lang->text('name')}}</th>
                <th>{{$lang->text('quantity')}}</th>
                <th>{{$lang->text('price')}}</th>
                <th>{{$lang->text('control')}}</th>
            </tr>
            </thead>
            <tbody>
            @isset($Cart)
                @foreach($Cart->items as $index => $item)
                    <tr>
                        <td>
                            <img src="{{asset($item->product->image)}}" style="width: 100px;height: 150px" alt="product-img"/>
                        </td>
                        <td>{{$item->product-> name}}</td>
                        <td>
                            <input type="number" min="0" value="{{$item->quantity}}"/>
                        </td>
                        <td>{{CURRENCY_SYMBOL.$item->product->price}}</td>
                        <td>
                            <form method="POST" action="{{route('CartItem.destroy',$item)}}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button id="remove_row" type="submit" class="btn">
                                    <i class="fa fa-trash" style="color:red"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
        {{--TODO::subtotal shoppping cart--}}
        <div class="container">
            <button type="button" class="btn btn-warning">
                Proceed to checkout
            </button>
        </div>
    </div>

@endsection


