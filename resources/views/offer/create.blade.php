@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form" id='Create_Product' action="{{route('offer.store')}}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="container m-0 p-3">
                <div class="row">
                    <div class="col-12 p-0 row">
                        <div class="col-12 col-lg-4 py-3 px-3">
                            <h2>
                                {{$lang->text('add_offer')}}
                            </h2>
                        </div>
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>

                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label for="offer_name_input">
                            {{$lang->text('offer_name')}}
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               value="{{old('name')}}"
                               id="offer_name_input">
                        @error("name")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                    <div class="form-group col-md-6">
                        <label for="desc_input">
                            {{$lang->text('desc')}}
                        </label>
                        <input type="text" class="form-control @error('desc') is-invalid @enderror"
                               value="{{old('desc')}}"
                               name="desc"
                               id="desc_input">
                        @error("desc")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                    <div class="form-group col-md-6">
                        <label for  = "end_date_input">
                            {{$lang->text('end_date')}}
                        </label>
                        <input type = "date" class="form-control  @error('desc') is-invalid @enderror"
                               value="{{old('end_date')}}"
                               name = "end_date"
                               id   = "end_date_input">
                        @error("end_date")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                </div>{{--end of row--}}

                <div class="row">
                    <div class="col-md-3">
                        <label for  = "product_id_input">
                            {{$lang->text('product')}}
                        </label>
                        <select id="product_id_input" class="form-control">
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for  = "value_input">
                            {{$lang->text('value')}}
                        </label>
                        <input type="number" class="form-control"
                               step="0.01"
                               min="0"
                               id="value_input"
                        >
                    </div>
                    <div class="col-md-2">
                        <label for  = "min_quantity_input">
                            {{$lang->text('min_order_value')}}
                        </label>
                        <input type="number" class="form-control"
                               step="1"
                               min="1"
                               id="min_quantity_input"
                        >
                    </div>
                    <div class="col-md-2">
                        <label for  = "type_id_input">
                            {{$lang->text('discount_type_id')}}
                        </label>
                        <select id="type_id_input" class="form-control">
                            @foreach($discountTypes as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>
                            {{$lang->text('add_discount')}}
                        </label>
                        <a id="ADD_ROW" class="btn bg-info">
                            add product
                        </a>
                    </div>
                </div>
                <div class="row mt-2" style="overflow: scroll;">
                    <table
                        class="table display nowrap table-striped table-bordered scroll-horizontal" id="offers">
                        <thead>
                            <tr>
                                <th>{{$lang->text('product')}}</th>
                                <th>{{$lang->text('value')}}</th>
                                <th>{{$lang->text('min_order_value')}}</th>
                                <th>{{$lang->text('discount_type_id')}}</th>
                                <th>{{$lang->text('control')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>{{--end of row--}}
            </div>

            <div class="row mt-4">
                <div class="form-group col-md-2">
                    <button type="submit" form="Create_Product" class="btn btn-primary">
                        {{$lang->text('save')}}
                    </button>
                </div>
            </div>{{--end of row--}}
        </form>{{--end of form--}}
    </div>
@endsection
