@extends('layouts.main')

@section('content')
  
<div class="row">
  <div class="home-cover">
    <div class="home-cover--text">
      <h1>Phrase d'accroche</h1>
      <p>
        Description du site. Sed dignissim at orci vulputate euismod. Phasellus maximus pulvinar sapien. Aenean enim ligula, viverra eu nibh a, consequat pellentesque erat.
      </p>
    </div>
  </div>
</div>


@if (isset($isAdmin) && $isAdmin === 1)
  <div class="col-md-4 col-md-offset-8 text-right">
    <br/>
    <a class="btn btn-default" style="margin-bottom:15px;" href="/challenges/new"><i class="fa fa-plus-circle"></i> Create challenge</a>
  </div>

@endif


<div class="container-fluid">

  @foreach ($challenges as $challenge)
  <?php 
    // $id = $challenge->id;
    // $id;  
    // $test = $stats[1]->total;
  ?>
  
  
  <!-- {{ $challenge }} -->
  <div class="col-md-4">
    <div class="panel panel-challenge">
      <a href="/challenge/{{$challenge->name}}">
        <div class="panel-cover" style="background-image: url( {{$challenge->img_cover}} )">
          
        </div>
      </a>
      <div class="panel-body">
        <h3 class="text-center">{{ $challenge->name }}</h3>
        <p>
          {{ $challenge->description}}
        </p>
        <!-- <div class="row panel-overview text-center">
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">lightbulb_outline</i>
            <span class="indic-title">2 Ideas</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">people_outline</i>
            <span class="indic-title">{{ $test or 'Default' }} people</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">opacity</i>
            <span class="indic-title">{{ $test or 'Default' }} Ideas</span>
          </div>
        </div> -->
        <div class="row text-center">
          <a href="/challenge/{{$challenge->name}}" class="btn btn-main">Découvrir</a>
        </div>
      </div>
      
      
    </div>
  </div>
  @endforeach
  
</div>
@endsection
