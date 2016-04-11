@extends('layouts.main')

@section('content')
  
<div class="row">
  <div class="challenge-cover">
    <h2>{{ $challenge[0]->name }}</h2>
  
    <div class="time-left">
      <span class="time-left-indic">15 days left</span>
      <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
          <span class="sr-only">60% Complete</span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
    <div class="panel panel-overview row">
      <div class="panel-overview-indics col-md-10">
        <div class="row">
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">lightbulb_outline</i>
            <span class="indic-title">36 Ideas</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">people_outline</i>
            <span class="indic-title">24 Participants</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">opacity</i>
            <span class="indic-title">65 img points</span>
          </div>
        </div>
          
      </div>
      <div class="panel-overview-create col-md-2 text-center">
        <a href="#" class="nostyle">
          <i class="icon-indic material-icons">library_add</i>
          <span class="indic-title">create</span>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="row">
  
  <div class="container-fluid">
    <ul role="tablist" class="challenge-tab">
      <li role="presentation" class="active"><a href="#brief" aria-controls="brief" role="tab" data-toggle="tab">Brief</a></li>
      <li role="presentation"><a href="#ideas" aria-controls="ideas" role="tab" data-toggle="tab">Ideas</a></li>
      <li role="presentation" class="disabled"><a href="#results" aria-controls="results" role="tab" data-toggle="tab">Results</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active" id="brief">
        <h4>{{ $challenge[0]->status }}</h4>
        <p>
          {{ $challenge[0]->description }}
        </p>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="ideas">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <form class="form-inline">
              <div class="form-group pull-right form-filter">
                <label>Filter by</label>
                <select class="form-control">
                  <option>Last ideas</option>
                  <!-- <option>Most likes</option>
                  <option>Most rebounds</option> -->
                </select>
              </div>              
            </form>
            <br/>
          </div>
        </div>
        <div class="row">
          
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="panel panel-idea">
              <div class="panel-body">
                <h3>Idea title</h3>
                <p>
                  Sed sed <span class="idea-tag">lacinia</span> leo. Morbi <span class="idea-tag">ultricies</span> ipsum quis imperdiet malesuada. Etiam fringilla augue magna, sed pretium sapien tempor at. Integer non nunc nec lacus <span class="idea-tag">maximuss</span> convallis eget ac dolor. Proin ac dapibus tellus. Praesent id turpis efficitur <span class="idea-tag">sapien</span> lobortis pretium a interdum ex. Suspendisse id suscipit leo.
                </p>
                <span class="user-idea pull-right"><i class="material-icons">account_circle</i>Paul Marchand</span>
              </div>
              <div class="panel-idea-stats">
                <div class="stat-container--like stat-container">
                  <i class="fa fa-heart"></i>
                  <span class="stat-indic">12</span>
                </div>
                <div class="stat-container--rebound stat-container">
                  <i class="fa fa-share"></i>
                  <span class="stat-indic">3</span>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fade" id="results">
        No results yet
      </div>
    </div>

  </div>
</div>
  
@endsection
