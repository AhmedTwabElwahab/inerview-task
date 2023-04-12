<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}">

        <!-- fontAwesome -->
        <link rel="stylesheet" href="{{asset('css/lib/fontAwesome/all.min.css')}}">


        <!-- Start style include  -->
        @isset($CSS)
         @if(file_exists(public_path().DS.$CSS))
                <link rel="stylesheet" href="{{asset($CSS)}}"/>
            @endif
        @endisset
        <!-- End style include  -->
    </head>
<body>
    <div id="app">
        @include('layouts.navBar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>




    <!-- start script include  -->
    <script src="{{asset('js/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/lib/axios/axios.min.js')}}"></script>
    <script src="{{asset('js/lib/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/lib/fontAwesome/all.min.js')}}"></script>
    @isset($js)
        @if(file_exists(public_path().DS.$js))
            <script src="{{asset($js)}}"></script>
        @endif
    @endisset
    <!-- End script include  -->
</body>
</html>
