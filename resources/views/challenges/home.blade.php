@extends('layouts.main')

@section('content')


<div class="row">
  <div class="home-cover">
    <div class="home-cover--text">
      <h1>Story Juice</h1>
      <p>
        Combinez, racontez, innovez
      </p>
    </div>
  </div>
</div>


@if (isset($isAdmin) && $isAdmin == 1)
  <div class="col-md-4 col-md-offset-8 text-right">
    <br/>
    <a class="btn btn-default" style="margin-bottom:15px;" href="{{ url('/admin')}}"><i class="fa fa-lock"></i> Administration</a>

    <a class="btn btn-default" style="margin-bottom:15px;" href="{{ url('/challenges/new')}}"><i class="fa fa-plus-circle"></i> Create challenge</a>
  </div>

@endif


<div class="container-fluid challenges-container">

  <p class="text-center text-accroche">
    Quel challenge choisissez-vous<br/> pour changer le monde aujourd'hui ?
  </p>

  @foreach ($challenges as $challenge)

  @if ($challenge->status == 'live' )
  <!-- {{ $challenge }} -->
  <div class="col-md-4">
    <div class="panel panel-challenge">
      <a href="{{route ('challenge_detail', $challenge->name) }}">
        <div class="panel-cover" style="background-image: url( {{$challenge->img_cover}} )">

        </div>
      </a>
      <div class="panel-body">
        <h3 class="text-center">{{ $challenge->name }}</h3>
        <p>
          {{ $challenge->description}}
        </p>
        <div class="row panel-overview text-center">
          <div class="col-xs-4 text-center indic">
            <img src="{{asset('/img/picto/ideas.svg')}}" class="icon-indic" width="30" alt="Ideas" />
            <span class="indic-title"><strong>12</strong> Ideas</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="{{asset('/img/picto/people.svg')}}" class="icon-indic" width="30" alt="Ideas" />
            <span class="indic-title"><strong>{{ '12' }}</strong> people</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="{{asset('/img/picto/points.svg')}}" class="icon-indic" width="20" alt="Ideas" />
            <span class="indic-title"><strong>{{ '78' }}</strong> points</span>
          </div>
        </div>
        <div class="row text-center">
          <a href="{{route ('challenge_detail', $challenge->name) }}" class="btn btn-main">Découvrir</a>
        </div>
      </div>


    </div>
  </div>

    @elseif ($challenge->status == 'staging' && (isset($isAdmin) && $isAdmin === 1))
    <div class="col-md-4">
      <div class="panel panel-challenge">
        <a href="{{route ('challenge_detail', $challenge->name) }}">
          <div class="panel-cover" style="background-image: url( {{$challenge->img_cover}} )">

          </div>
        </a>
        <div class="panel-body">
          <h3 class="text-center"><span class="text-center" style="color:blue">{{$challenge->status}}</span> {{ $challenge->name }}</h3>
          <p>
            {{ $challenge->description}}
          </p>
          <div class="row panel-overview text-center">
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/ideas.svg')}}" class="icon-indic" width="30" alt="Ideas" />
              <span class="indic-title"><strong>12</strong> Ideas</span>
            </div>
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/people.svg')}}" class="icon-indic" width="30" alt="Ideas" />
              <span class="indic-title"><strong>{{ '12' }}</strong> people</span>
            </div>
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/points.svg')}}" class="icon-indic" width="20" alt="Ideas" />
              <span class="indic-title"><strong>{{ '78' }}</strong> points</span>
            </div>
          </div>
          <div class="row text-center">
            <a href="{{route ('challenge_detail', $challenge->name) }}" class="btn btn-main">Découvrir</a>
          </div>
        </div>


      </div>
    </div>
    @elseif ($challenge->status == 'closed' && (isset($isAdmin) && $isAdmin === 1))
    <div class="col-md-4">
      <div class="panel panel-challenge">
        <a href="{{route ('challenge_detail', $challenge->name) }}">
          <div class="panel-cover" style="background-image: url( {{$challenge->img_cover}} )">

          </div>
        </a>
        <div class="panel-body">
          <h3 class="text-center"><span class="text-center" style="color:red">{{$challenge->status}}</span> {{ $challenge->name }}</h3>
          <p>
            {{ $challenge->description}}
          </p>
          <div class="row panel-overview text-center">
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/ideas.svg')}}" class="icon-indic" width="30" alt="Ideas" />
              <span class="indic-title"><strong>12</strong> Ideas</span>
            </div>
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/people.svg')}}" class="icon-indic" width="30" alt="Ideas" />
              <span class="indic-title"><strong>{{ '12' }}</strong> people</span>
            </div>
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/points.svg')}}" class="icon-indic" width="20" alt="Ideas" />
              <span class="indic-title"><strong>{{ '78' }}</strong> points</span>
            </div>
          </div>
          <div class="row text-center">
            <a href="{{route ('challenge_detail', $challenge->name) }}" class="btn btn-main">Découvrir</a>
          </div>
        </div>


      </div>
    </div>
    @endif
  @endforeach

</div>
@endsection
