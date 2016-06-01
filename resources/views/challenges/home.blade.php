@extends('layouts.main')

@section('content')


<div class="mdl-grid">
  <h3>Challenge list</h3>
</div>

@if (isset($isAdmin) && $isAdmin === 1)
  <a href="/challenges/new">Create challenge</a>
@else
  <p>Salut</p>
@endif


<div class="mdl-grid">
  @foreach ($challenges as $challenge)
  <div class="mdl-cell mdl-cell--4-col-desktop">
    <div class="mdl-card mdl-shadow--2dp">
      <div class="mdl-card__title mdl-card--expand">
        <h2 class="mdl-card__title-text">{{ $challenge->name}}</h2>
      </div>
      <div class="mdl-card__supporting-text">
        <strong>{{ $challenge->status }}</strong><br/>
        {{ $challenge->description}}
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a href="{{ route('challenge_detail', $challenge->name)}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
          View details
        </a>
      </div>
    </div>
  </div>
  @endforeach

</div>
@endsection
