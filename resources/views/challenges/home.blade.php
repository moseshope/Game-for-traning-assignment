@extends('layouts.main')

@section('content')


<div class="row">
  <div class="home-cover">
    <div class="home-cover--text">
      <h1>Story Juice</h1>
      <p>
        @lang('home.tagline')
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
  @lang('home.main')
  </p>

  @foreach ($challenges as $challenge)

  @if ($challenge->status != 'staging'  )
  <div class="col-md-4">
    <div class="panel panel-challenge">

      <a href="{{route ('challenge_detail', $challenge->url) }}">
        @if (Storage::disk('covers')->has( $challenge->id . '_' . $challenge->url . '.jpg' ))
        <div class="panel-cover" style="background-image:url(../images/{{ $challenge->id . '_' . $challenge->url . '.jpg' }})"></div>
        @else
        <div class="panel-cover" style="background-image: url( {{$challenge->img_cover}} )"></div>
        @endif
      </a>
      <div class="panel-body">
        <h3 class="text-center">{{ $challenge->name }}</h3>
        <p>
          {{ $challenge->description}}
        </p>


        <div class="time-left">
          @if ($challenge->status == 'closed')
            <div class="text-center">
              <strong><i class="fa fa-lock"></i> @lang('challenge.challenge-closed')</strong>
            </div>
          @else
            <span class="time-left-indic">4 days left</span>
          @endif

                <div class="progress timeline" style="background-color:#fff" data-end-date="{{ $challenge->end_date }}" data-start-date="{{ $challenge->start_date }}">
            <div style="width:0%" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
              <span class="sr-only">60% Complete</span>
            </div>
          </div>
        </div>
        <div class="row panel-overview text-center">
          <div class="col-xs-4 text-center indic">
            <img src="{{asset('/img/picto/ideas.svg')}}" class="icon-indic" width="40" alt="Ideas" />
            <span class="indic-title"><strong>{{ $challenge->countIdeas }}</strong> @lang('challenge.ideas')</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="{{ asset('img/picto/users.svg') }}" class="icon-indic" width="50" alt="Ideas" />
            <span class="indic-title"><strong>{{ $challenge->countDistinctUsers }}</strong> @lang('challenge.creatives')</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="{{ asset('img/picto/picto-jus2.svg') }}" class="icon-indic" width="40" alt="Ideas" />
            <span class="indic-title indic-juice" nb-rebounds="{{ $challenge->sumRebounds }}" nb-votes="{{ $challenge->sumVotes }}" nb-ideas="{{ $challenge->countIdeas }}"><strong>{{ $challenge->sumRebounds }}</strong> @lang('challenge.points')</span>
          </div>
        </div>
        <div class="row text-center">
          <a href="{{route ('challenge_detail', $challenge->url) }}" class="btn btn-main">
            @if ($challenge->status == 'closed')
              @lang('challenge.cta-home-closed')
            @else
              @lang('challenge.cta-home')
            @endif
          </a>
        </div>
      </div>


    </div>
  </div>

    @elseif ($challenge->status == 'staging' && (isset($isAdmin) && $isAdmin == 1))
    <div class="col-md-4">
      <div class="panel panel-challenge" style="border-color:blue">
        <a href="{{route ('challenge_detail', $challenge->url) }}">
          @if (Storage::disk('covers')->has( $challenge->id . '_' . $challenge->url . '.jpg' ))
          <div class="panel-cover" style="background-image:url(../images/{{ $challenge->id . '_' . $challenge->url . '.jpg' }})"></div>
          @else
          <div class="panel-cover" style="background-image: url( {{$challenge->img_cover}} )"></div>
          @endif
        </a>
        <div class="panel-body">
          <h3 class="text-center"><span class="label label-info">{{$challenge->status}}</span> {{ $challenge->name }}</h3>
          <p>
            {{ $challenge->description}}
          </p>
          <div class="text-center text-info">
            <strong><i class="fa fa-exclamation-triangle"></i> You can see this challenge because you are administrator</strong>
          </div>
          <div class="row panel-overview text-center">
            <div class="col-xs-4 text-center indic">
              <img src="{{asset('/img/picto/ideas.svg')}}" class="icon-indic" width="40" alt="Ideas" />
              <span class="indic-title"><strong>{{ $challenge->countIdeas }}</strong> @lang('challenge.ideas')</span>
            </div>
            <div class="col-xs-4 text-center indic">
              <img src="{{ asset('img/picto/users.svg') }}" class="icon-indic" width="50" alt="Ideas" />
              <span class="indic-title"><strong>{{ $challenge->countDistinctUsers }}</strong> @lang('challenge.creatives')</span>
            </div>
            <div class="col-xs-4 text-center indic">
              <img src="{{ asset('img/picto/picto-jus2.svg') }}" class="icon-indic" width="40" alt="Ideas" />
              <span class="indic-title indic-juice" nb-rebounds="{{ $challenge->sumRebounds }}" nb-votes="{{ $challenge->sumVotes }}" nb-ideas="{{ $challenge->countIdeas }}"><strong>{{ $challenge->sumRebounds }}</strong> @lang('challenge.points')</span>
            </div>
          </div>
          <div class="row text-center">
            <a href="{{route ('challenge_detail', $challenge->url) }}" class="btn btn-main">@lang('challenge.cta-home')</a>
          </div>
        </div>


      </div>
    </div>
    @endif
  @endforeach

</div>
@endsection
