@extends('layouts.main')

@section('content')
  
<div class="mdl-grid">
  <div class="mdl-cell mdl-cell--12-col-desktop">
    <h2>{{ $challenge[0]->name }}</h2>
    <h4>{{ $challenge[0]->status }}</h4>
    <p>
      {{ $challenge[0]->description }}
    </p>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
      Participez
    </button>
  </div>
</div>
@endsection
