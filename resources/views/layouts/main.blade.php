<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GEM In Game</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
    <link rel="stylesheet" href="/css/app.css" />
    
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <style>
      body{
        font-family: Roboto;
      }
    </style>

</head>

<body id="app-layout">
  <div class="mdl-layout mdl-js-layout">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title"><a href="/" style="color:#fff">GEM In Game</a></span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
          @if (Auth::guest())
            <a href="{{ url('/login') }}" class="mdl-navigation__link" href="">Login</a>
            <a href="{{ url('/register') }}" class="mdl-navigation__link" href="">Register</a>
          @else
            <a href="{{ url('/challenges') }}" class="mdl-navigation__link" href="">Challenges</a>
            <button id="menu-user" class="mdl-button mdl-js-button">
              <i class="fa fa-user"></i> {{ Auth::user()->name }} <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="menu-user">
              <li class="mdl-menu__item"><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
          @endif
        </nav>
      </div>
    </header>
    <!-- <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Title</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
      </nav>
    </div> -->
    <main class="mdl-layout__content">
      @yield('content')
    </main>
    <footer class="mdl-mini-footer">
      <div class="mdl-mini-footer__left-section">
        <div class="mdl-logo">Title</div>
        <ul class="mdl-mini-footer__link-list">
          <li><a href="#">Help</a></li>
          <li><a href="#">Privacy & Terms</a></li>
        </ul>
      </div>
    </footer>
  </div>
  
  
    

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
