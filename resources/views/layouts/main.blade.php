<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Story Juice - Create ideas !</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @stack('styles')
    <!-- Styles -->
    <link rel="icon" type="image/jpg" href="{{url( 'favicon.jpg')}}" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('jquery-ui/jquery-ui.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="http://s.mlcdn.co/animate.css">
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
          <a class="navbar-brand" href="{{ url('/') }}"><img height="35" src="{{ asset('/img/logo-sj.svg')}}" /></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
              <li><a href="{{ url('/challenges') }}"><strong>Challenges</strong></a></li>
              <li><a href="{{ url('/about') }}">About</a></li>
              <li data-toggle="modal" data-target=".modal-login"><a href="#">Login</a></li>
              <li>
                <a data-toggle="modal" data-target=".modal-register" href="">Register</a>
              </li>
            @else
              <li><a href="{{ url('/challenges') }}"><strong>Challenges</strong></a></li>
              <li><a href="{{ url('/about') }}">About</a></li>
              <!-- <li><a href="#">
                <div class="notif-counter">
                  2
                </div>
                <i class="fa fa-bell fa-lg"></i></a>
              </li> -->
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

  @if (Auth::guest())
  <!-- Modal -->
  <div class="modal fade modal-login" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title text-center">Login</h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
              {!! csrf_field() !!}
              <p class="text-center">Login to start innovating !</p>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                  <div class="col-md-8 col-md-offset-2">
                    <div class="input-container">
                      <i class="icon-indic material-icons">mail</i>
                      <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                  <div class="col-md-8 col-md-offset-2">
                    <div class="input-container">
                      <i class="icon-indic material-icons">lock</i>
                      <input placeholder="Password" type="password" class="form-control" name="password">
                    </div>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>


              <div class="form-group">
                  <div class="col-md-4 col-md-offset-2">
                      <div class="checkbox" style="padding-top:0">
                          <label>
                              <input type="checkbox" name="remember"> Remember Me
                          </label>
                      </div>
                  </div>
                  <div class="col-md-4 text-right">
                    <a href="{{ url('/password/reset') }}" class="lost-password">Forgot Your Password?</a>
                  </div>
              </div>

              <div class="form-group text-center">
                <button type="submit" class="btn btn-main">
                    Login
                </button>
              </div>

              <p>Not a member yet ? <a onclick="$('.modal-login').modal('hide');$('.modal-register').modal('show')" class="color-main">Register</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-register" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title text-center">Register</h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
              {!! csrf_field() !!}
              <p class="text-center">Register to start innovating !</p>

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                <div class="col-md-8 col-md-offset-2">
                  <div class="input-container">
                    <i class="icon-indic material-icons">account_circle</i>
                      <input placeholder="Username" type="text" class="form-control" name="name" value="{{ old('name') }}">
                  </div>
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="input-container">
                      <i class="icon-indic material-icons">mail</i>
                      <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                  <div class="col-md-8 col-md-offset-2">
                    <div class="input-container">
                      <i class="icon-indic material-icons">lock</i>
                      <input placeholder="Password" type="password" class="form-control" name="password">
                    </div>
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                <div class="col-md-8 col-md-offset-2">
                  <div class="input-container">
                    <i class="icon-indic material-icons">lock</i>
                    <input placeholder="Confirm password" type="password" class="form-control" name="password_confirmation">
                  </div>
                      @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group text-center">
                <button type="submit" class="btn btn-main">
                    Register
                </button>
              </div>

              <p>Already a member ? <a onclick="$('.modal-register').modal('hide');$('.modal-login').modal('show')" class="color-main">Login in</a></p>

          </form>
        </div>
      </div>
    </div>
  </div>

  @endif


    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://cdn.date-fns.org/v1.3.0/date_fns.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
    <script src="{{ asset('jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    @stack('scripts')
    <script>
      $('.js-btn-votes').on('click', function(){
        $.post('{{ route("challenge_vote")}}', {id: $(this).attr("data-id"), _token: '{{ csrf_token()}}'}, function(data){
          $( ".js-btn-votes[data-id='"+$(this).attr("data-id")+"'] .stat-indic" ).html(data);
          var heart = $(this).find('.fa');
          if(heart.hasClass('fa-heart-o')){
            heart.removeClass('fa-heart-o').addClass('fa-heart');
          }else{
            heart.removeClass('fa-heart').addClass('fa-heart-o');
          }
        }.bind(this))
        //add class
      });

      $('.js-btn-rebound').on('click', function(){
        var ideaID = $(this).attr("data-id");
        //OUVRE LA POPIN
        $('#modalCreate').modal('show');
        $('.ideas-propose').show('fast');
        $('.ideas-create').hide('fast');
        $('.js-modify-elements').hide();
        $('.js-btn-switch-write').show('fast');
        $('.ideas-propose h3').html('<strong>Proposer une idée</strong>');
        $('.story-location').html($('.tag-place-'+ideaID).html());
        $('.story-resource').html($('.tag-ressource-'+ideaID).html());
        $('.story-advantage').html($('.tag-quest-'+ideaID).html());
        $('.story-user').html($('.tag-character-'+ideaID).html());
        $('input[name=character]').val($('.tag-character-'+ideaID).html());
        $('input[name=place]').val($('.tag-place-'+ideaID).html());
        $('input[name=ressource]').val($('.tag-ressource-'+ideaID).html());
        $('input[name=quest]').val($('.tag-quest-'+ideaID).html());
        $('input[name=warning]').val($('.tag-warning-'+ideaID).html());
        $('input[name=treasure]').val($('.tag-treasure-'+ideaID).html());
        $('input[name=rebound]').val(ideaID);
        $('.story-revenue').html($('.tag-warning-'+ideaID).html());
        $('.story-game-changer').html($('.tag-treasure-'+ideaID).html());

      });


    </script>
</body>
</html>
