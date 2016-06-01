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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      body{
        font-family: Lato;
      }
    </style>

</head>

<body id="app-layout">

  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">GEMinGAME</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
              <li>
                <a href="{{ url('/login') }}" href="">Login</a>
              </li>
              <li>
                <a href="{{ url('/register') }}" href="">Register</a>
              </li>
            @else
              <li><a href="{{ url('/challenges') }}"><strong>Challenges</strong></a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">
                <div class="notif-counter">
                  2
                </div>
                <i class="fa fa-bell fa-lg"></i></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">account_circle</i> {{ Auth::user()->name }}  <i class="fa fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Profile</a></li>
                  <li><a href="{{ url('/logout') }}">Log out</a></li>
                </ul>
              </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <main class="container-fluid">
      @yield('content')
    </main>
    <!-- <footer class="footer">
      <div class="container-fluid">
        <p class="text-muted text-right"><i class="fa fa-copyright"></i> Copyright GEM - 2016</p>
      </div>
    </footer> -->
  </div>




    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    <script>
      $('.js-btn-votes').on('click', function(){
        $.post('{{ route("challenge_vote")}}', {id: $(this).attr("data-id"), _token: '{{ csrf_token()}}'}, function(data){
          $( ".js-btn-votes[data-id='"+$(this).attr("data-id")+"'] .stat-indic" ).html(data);
        }.bind(this))
      });

      $('.js-btn-rebound').on('click', function(){
        var ideaID = $(this).attr("data-id");
        //OUVRE LA POPIN
        console.log('click rebound button');
        $('.btn-popin-rebound').on('click', function(){
          challengeRebound(ideaID);
        })

      });
      var challengeRebound = function(ideaID){
        $.post('{{ route("challenge_detail_rebound")}}', {id: ideaID, _token: '{{ csrf_token()}}', title: "$('textareaClass').val", content: "$('textareaClass').val"}, function(data){
          window.location.reload();
        }.bind(this))
      }
    </script>
</body>
</html>
