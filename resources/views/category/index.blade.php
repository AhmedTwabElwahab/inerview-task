@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>
                    {{$lang->text('categories')}}
                </h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{route('category.create')}}">
                    <span class="btn btn-primary">
                        <span class="fas fa-plus"></span>
                        {{$lang->text('add_category')}}
                    </span>
                </a>
            </div>
            <div class="col-12 divider" style="min-height: 2px;"></div>
        </div>

        <table class="table table-light table-bordered text-center" id="DataTable">
            <thead>
                <tr>
                    <th>{{$lang->text('num')}}</th>
                    <th>{{$lang->text('name')}}</th>
                    <th>{{$lang->text('control')}}</th>
                </tr>
            </thead>
            <tbody>
            @isset($categories)
                @foreach($categories as $index => $category)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$category -> name}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('category.edit',$category -> id)}}"
                                   class="btn box-shadow-3 ">
                                    <i class="fa fa-edit" style="color:#0048ff"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>

        <div class="d-flex justify-content-center" id="paginate">
            {!! $categories->links() !!}
        </div>
    </div>

@endsection


