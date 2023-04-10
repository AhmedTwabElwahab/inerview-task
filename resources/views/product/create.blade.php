<?php
use App\Models\Category;
/**
 * @var Category $category
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form" id='Create_Product' action="{{route('product.store')}}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="container m-0 p-3">
                <div class="col-12">
                    <div class="col-12 p-0 row">
                        <div class="col-12 col-lg-4 py-3 px-3">
                            <h2>
                                {{$lang->text('add_product')}}
                            </h2>
                        </div>
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label for="category_id_input">{{$lang->text('category')}}</label>
                        <select id="category_id_input" class="form-control" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error("category_id")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                    <div class="form-group col-md-4">
                        <label for="barcode_input">
                            {{$lang->text('barcode')}}
                        </label>
                        <input type="text" class="form-control" name="barcode"
                               id="barcode_input">
                        @error("barcode")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                </div>
                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <label for="product_name_input">
                            {{$lang->text('product_name')}}
                        </label>
                        <input type="text" class="form-control"
                               name="name"
                               id="product_name_input">
                        @error("name")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                    <div class="form-group col-md-6">
                        <label for="desc_input">
                            {{$lang->text('desc')}}
                        </label>
                        <input type="text" class="form-control"
                               name="desc"
                               id="desc_input">
                        @error("desc")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                </div>{{--end of row--}}

                <div class="row mt-3">
                    <div class="form-group col-md-3">
                        <label for="weight_input">
                            {{$lang->text('weight')}}
                        </label>
                        <input type="number" class="form-control"
                               name="weight"
                               step="0.01"
                               min="0"
                               id="weight_input">
                        @error("weight")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                    <div class="form-group col-md-3">
                        <label for="quantity_in_Stock_input">
                            {{$lang->text('quantity_in_Stock')}}
                        </label>
                        <input type="number" class="form-control"
                               name="quantity_in_Stock"
                               step="0.01"
                               min="0"
                               id="quantity_in_Stock_input">
                        @error("quantity_in_Stock")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
                    <div class="form-group col-md-3">
                        <label for="price_input">
                            {{$lang->text('price')}}
                        </label>
                        <input type="number" class="form-control"
                               name="price"
                               step="0.01"
                               min="0"
                               id="price_input">
                        @error("price")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>{{--end of form-group--}}
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
