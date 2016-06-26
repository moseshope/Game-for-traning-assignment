@extends('layouts.main')

@section('content')
<br/>

<div class="row text-center">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <i class="icon-indic material-icons">lightbulb_outline</i> <span class="counter">{{ $ideasNB }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <i class="icon-indic material-icons">people_outline</i> <span class="counter">{{ $usersNB }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-body">
        <i class="icon-indic material-icons">flag</i> <span class="counter">{{ $challengesNB }}</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <ul class="list-group">
      <a style="margin-bottom:15px;" href="/challenges/new">
        <li class="list-group-item active">
          <i class="fa fa-plus-circle"></i> Create challenge
        </li>
      </a>
      @foreach ($challenges as $challenge)
      <li class="list-group-item">
        <span>
          <a href="{{route ('challenge_detail', $challenge->url) }}"><i class="fa fa-eye"></i></a>
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
          <a href="{{route ('challenge_edit', $challenge->url) }}"><i class="fa fa-pencil"></i> Manage challenge</a>
        </div>
        
      </li>
      @endforeach
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3" id="users">
    <div class="list-group-item list-group-item-success">
      <i class="fa fa-user"></i> User list
      <input class="search pull-right form-control" placeholder="Search user..." style="width:200px" placeholder="Search" />
      <div class="clearfix"></div>
    </div>
    <ul class="list-group list" >
      @foreach ($users as $user)
      <li class="list-group-item">
        @if ($user->isAdmin)
        <span>
          <span class="label label-primary"><i class="fa fa-user-secret"></i> Admin.</span> 
        </span>
        @endif
        <strong class="username">{{$user->name}}</strong> <i class="fa fa-envelope"></i> {{$user->email}} <small>{{$user->created_at}}</small>
        
        <div class="pull-right">
          @if ($user->isAdmin)
            <a href="/admin/{{ $user->id }}/rights" class="text-danger"><i class="fa fa-times"></i> Remove admin rights</a>
          @else
            <a href="/admin/{{ $user->id }}/rights" class="text-success"><i class="fa fa-plus"></i> Add admin rights</a>
          @endif
        </div>
        
      </li>
      @endforeach
    </ul>
  </div>
</div>
@push('scripts')
  <script src="{{ asset('js/admin.js') }}"></script>
@endpush



@endsection
