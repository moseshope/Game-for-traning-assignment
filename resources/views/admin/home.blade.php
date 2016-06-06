@extends('layouts.main')

@section('content')
<br/>
<div class="row text-center">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <i class="icon-indic material-icons">lightbulb_outline</i> {{ $ideasNB }}
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <i class="icon-indic material-icons">people_outline</i> {{ $usersNB }}
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <i class="icon-indic material-icons">flag</i> {{ $challengesNB }}
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <ul class="list-group">
      @foreach ($challenges as $challenge)
        <li class="list-group-item">
          <span>
            <a href="{{route ('challenge_detail', $challenge->name) }}"><i class="fa fa-link"></i></a>
          </span>
          <strong>{{$challenge->name}}</strong>
          @if ($challenge->status == 'live')
            <span class="label label-success"><i class="fa fa-play-circle"></i> LIVE</span>
          @elseif ($challenge->status == 'staging')
            <span class="label label-primary">STAGING</span>
          @else
            <span class="label label-default">CLOSED</span>
          @endif
          
          <div class="pull-right">
            <a href="{{route ('challenge_edit', $challenge->name) }}"><i class="fa fa-pencil"></i> Manage challenge</a>
          </div>
          
        </li>
      @endforeach
    </ul>
  </div>
</div>

<div class="row">
  <a class="btn btn-default" style="margin-bottom:15px;" href="/challenges/new"><i class="fa fa-plus-circle"></i> Create challenge</a>
</div>

@endsection
