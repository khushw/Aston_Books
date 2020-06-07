<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,600" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    
    {{-- for the index page styling --}}
    {{-- <link href="https://getbootstrap.com/docs/4.0/examples/carousel/carousel.css" rel="stylesheet"> --}}
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('extra-css')
    
</head>
<body id="body">
    {{-- anchor here so user can click and come top of page, points to the one in the --}}
    <a name="top"></a>
    <div id="app"> 
        {{-- below includes the navbar from the  inc folder --}}
        @include("inc.navbar")
           <div class="container">
                {{-- below includes the messages for succesffully listing the product or vice versa --}}
                @include("inc.messages")
                {{-- this displays the content from index.blade file currently as that file @extends this one --}}
                @yield("content")
           </div>

    </div>

    @yield("index")
    
    @yield("extra-js")

    <!-- FOOTER -->
    <hr>
    <footer class="container">
        <p class="float-right"><a href="#top">Back to top</a></p>
        <p>© 2019-2020 Aston Books, Ltd. · <a href="#">Privacy</a> · <a href="#">Terms</a> .<a href="/messages">Messages</a></p>
      </footer>
</body>
</html>
