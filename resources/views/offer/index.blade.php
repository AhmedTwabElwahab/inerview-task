@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>
                    {{$lang->text('Offers')}}
                </h3>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="{{route('offer.create')}}">
                    <span class="btn btn-primary">
                        <span class="fas fa-plus"></span>
                        {{$lang->text('add_offer')}}
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
                    <th>{{$lang->text('desc')}}</th>
                    <th>{{$lang->text('Start_date')}}</th>
                    <th>{{$lang->text('end_date')}}</th>
                </tr>
            </thead>
            <tbody>
            @isset($offers)
                @foreach($offers as $index => $offer)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$offer -> name}}</td>
                        <td>{{$offer -> desc}}</td>
                        <td>
                            {{ DateFormat($offer -> created_at)}}
                        </td>
                        <td>{{ DateFormat($offer -> end_date)}}</td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>

        <div class="d-flex justify-content-center" id="paginate">
            {!! $offers->links() !!}
        </div>
    </div>

@endsection


