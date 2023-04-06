@extends('layouts.app')

@section('content')
    <div class="container p-3">
        <div class="col-12">
            <div class="col-12 p-0 row">
                <div class="col-12 col-lg-4 py-3 px-3">
                    <h3>
                        {{$lang->text('add_category')}}
                    </h3>
                </div>
            </div>
            <div class="col-12 divider" style="min-height: 2px;"></div>
        </div>
        <form class="form" id ='Create_category' action="{{route('category.store')}}"
                method="POST"
                enctype="multipart/form-data">
            @csrf

            <div class="row mt-2">
                <div class="form-group col-md-4">
                    <label for  = "category_name_input">
                        {{$lang->text('name')}}
                    </label>
                    <input type = "text" class="form-control"
                            name = "name"
                            id   = "category_name_input">
                    @error("name")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>{{--end of form-group--}}
            </div>{{--end of row--}}
        </form>{{--end of form--}}
    </div>
    <div class="container mt-4">
        <div class="form-group col-md-2">
            <button type="submit" form ="Create_category" class="btn btn-primary">
                {{$lang->text('save')}}
            </button>
        </div>
    </div>{{--end of row--}}
@endsection
