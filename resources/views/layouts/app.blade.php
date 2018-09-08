<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/dlike.js') }}" defer></script>
    <script src="{{ asset('/js/like.js') }}" defer></script>
    <script type="text/javascript">
    var url   = "{{route('like')}}"; 
    var url_dis   = "{{route('dislike')}}"; 
    var url_best  = "{{route('best')}}"; 
    var token = "{{Session::token()}}";

    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sheet.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
    <div id="app">
<div class="topnav">
  <a class="active" href="{{url('view')}}">Home</a>
  <a href="{{url('best_articles')}}">Best Articles</a>
  <a href="{{url('live_search')}}">Search</a>
  <a href="{{url('AddArticle')}}">Add articles</a>
   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    Sections
   <span class="caret"></span>
   </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdown">
                                    
                                    <a class="dropdown-item" href="{{url('arts')}}"> 
                                    Arts </a>
                                     <a class="dropdown-item" href="{{url('business')}}"> 
                                    Business </a> 
                                     <a class="dropdown-item" href="{{url('sport')}}"> 
                                    Sport </a>
                                     <a class="dropdown-item" href="{{url('history')}}"> 
                                    History </a> 
                                     <a class="dropdown-item" href="{{url('politics')}}"> 
                                    Politics </a>
                                     <a class="dropdown-item" href="{{url('science')}}"> 
                                    Science </a> 
                                     <a class="dropdown-item" href="{{url('sex')}}"> 
                                    Sex </a>
                                     <a class="dropdown-item" href="{{url('crime')}}"> 
                                    Crime </a> 
                                     <a class="dropdown-item" href="{{url('tech')}}"> 
                                    Tech </a>
                                     <a class="dropdown-item" href="{{url('world')}}"> 
                                    World </a> 
                                     <a class="dropdown-item" href="{{url('view')}}"> 
                                    All Sections </a>
                                </div>
 
  <a href="{{url('statistics')}}">services</a>
  <a href="{{url('contact')}}">Contact</a>
  <div class="topnav-right">
                        @guest
  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @else
   
   <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
   <img src="/image/avatars/{{ Auth::user()->image }}" style="width:32px; height:32px;  border-radius:50%"> {{ Auth::user()->name }} <span class="caret"></span>
   </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdown">
                                    
                                    <a class="dropdown-item" href="{{url('profile/' . Auth::user()->id) }}"> 
                                    Profile </a> 
                                    <a class="dropdown-item" href="{{url('/edit_profile')}}"> 
                                    Edit Profile </a> 
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a> 
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                        @endguest
  </div>
                   
</div> 


  <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>
</html>
