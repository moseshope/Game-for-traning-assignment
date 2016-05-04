@extends('layouts.main')

@section('content')
  
<div class="row">
  <div class="challenge-cover" style="background-image:url({{$challenge->img_cover}})">
    <h2>{{ $challenge->name }}</h2>
    <h4>{{ $challenge->description }}</h4>
    
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
            <span class="indic-title">{{ count($ideas) }} Ideas</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">people_outline</i>
            <span class="indic-title">{{ $ideaNBUser }} Participants</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <i class="icon-indic material-icons">opacity</i>
            <span class="indic-title">65 img points</span>
          </div>
        </div>
          
      </div>
      <div class="panel-overview-create col-md-2 text-center">
        <a data-toggle="modal" data-target="#modalCreate" class="nostyle btn-recap">
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
        <div class="row">
          <div class="col-md-offset-2 col-md-8">
            <h4>Status : <strong>{{ $challenge->status }}</strong></h4>
            <p>
              {{ $challenge->content }}
            </p>
          </div>
        </div>      
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
          
          @foreach ($ideas as $idea)
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="panel panel-idea">
              <div class="panel-body">
                <h3>{{ $idea->title }}</h3>
                <p>
                  {{ $idea->content }}
                </p>
                <span class="user-idea pull-right"><i class="material-icons">account_circle</i>{{ $idea->IDUser }}</span>
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
          @endforeach
        </div>
        
      </div>
      <div role="tabpanel" class="tab-pane fade" id="results">
        No results yet
      </div>
    </div>

  </div>
</div>

@if (isset($userLogged) && $userLogged === true)
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-create">
    <div class="modal-content">
      <div class="modal-header text-center">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h2 class="modal-title text-uppercase">{{ $challenge->name }}</h2>
        <p>
          {{ $challenge->description }}
        </p>
      </div>

      <div class="challenge-steps text-center row" role="tablist">
        <div role="presentation" class="challenge-step col-sm-2 active">
          <a href="#character" role="tab" data-toggle="tab">
            <div class="step-nb">
              <i class="material-icons">face</i>
            </div>
            <div class="step-title">
              Personnage
            </div>
          </a>
        </div>
        <div role="presentation" class="challenge-step col-sm-2" href="#place" aria-controls="home" role="tab" data-toggle="tab">
          <a href="#place" role="tab" data-toggle="tab">
            <div class="step-nb">
              <i class="material-icons">place</i>
            </div>
            <div class="step-title">
              Lieu
            </div>
          </a>
        </div>
        <div role="presentation" class="challenge-step col-sm-2">
          <a href="#ressource" role="tab" data-toggle="tab">
            <div class="step-nb">
              <i class="material-icons">battery_charging_full</i>
            </div>
            <div class="step-title">
              Ressource
            </div>
          </a>
        </div>
        <div role="presentation" class="challenge-step col-sm-2">
          <a href="#quest" role="tab" data-toggle="tab">
            <div class="step-nb">
              <i class="material-icons">flag</i>
            </div>
            <div class="step-title">
              Quête
            </div>
          </a>
        </div>
        <div role="presentation" class="challenge-step col-sm-2">
          <a href="#warning" role="tab" data-toggle="tab">
            <div class="step-nb">
              <i class="material-icons">warning</i>
            </div>
            <div class="step-title">
              Element perturbateur
            </div>
          </a>
        </div>
        <div role="presentation" class="challenge-step col-sm-2">
          <a href="#treasure" role="tab" data-toggle="tab">
            <div class="step-nb">
              <i class="material-icons">stars</i>
            </div>
            <div class="step-title">
              Trésor
            </div>
          </div>
        </a>
      </div>
      <div class="modal-body">
        
        <div class="tab-content collapse in">
          <div role="tabpanel" class="tab-pane fade in active" id="character">
            <h3 class="text-center">Quel personnage ?</h3>
            <br/>
            <div class="element clearfix">
              <div class="col-md-8 col-md-offset-2">
                <div class="row text-center">
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Superman</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Batman</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane fade" id="place">
            <h3 class="text-center">Quel lieu ?</h3>
            <br/>
            <div class="element clearfix">
              <div class="col-md-8 col-md-offset-2">
                <div class="row text-center">
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Gotham</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>New York</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane fade" id="ressource">
            <h3 class="text-center">Quelle ressource ?</h3>
            <br/>
            <div class="element clearfix">
              <div class="col-md-8 col-md-offset-2">
                <div class="row text-center">
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>$$DOLLARS$$</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Alien Power</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane fade" id="quest">
            <h3 class="text-center">Quelle quête?</h3>
            <br/>
            <div class="element clearfix">
              <div class="col-md-8 col-md-offset-2">
                <div class="row text-center">
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Save Gotham</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Save the world</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane fade" id="warning">
            <h3 class="text-center">Quel élément perturbateur?</h3>
            <br/>
            <div class="element clearfix">
              <div class="col-md-8 col-md-offset-2">
                <div class="row text-center">
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>The Joker</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>Mario the plumber</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane fade" id="treasure">
            <h3 class="text-center">Quel trésor ?</h3>
            <br/>
            <div class="element clearfix">
              <div class="col-md-8 col-md-offset-2">
                <div class="row text-center">
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>A cookie</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="panel panel-default panel-element">
                      <div class="panel-body">
                        <strong>A gameboy color</strong>
                      </div>
                      <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="Difficulty of the element">
                        <i class="material-icons">star</i><i class="material-icons">star</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="idea-form collapse">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <form action="/challenge/{{ $challenge->id }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="text" name="title" class="form-control" placeholder="My idea title">
                </div>
                <div class="form-group">
                  <textarea name="content" class="form-control" rows="7"></textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <div class="hidden elements-form">
                  <input type="hidden" name="character" />
                  <input type="hidden" name="place" />
                  <input type="hidden" name="ressource" />
                  <input type="hidden" name="quest" />
                  <input type="hidden" name="warning" />
                  <input type="hidden" name="treasure" />
                </div>
              </form>
            </div>
          </div>
          
        </div>

      </div>
      
      <div class="modal-footer">
        <div class="recap-elements">
          <div class="col-md-2">
            <div class="recap-element">
              <div class="element-name"></div>
              <div class="element-rating"></div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="recap-element">
              <div class="element-name"></div>
              <div class="element-rating"></div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="recap-element">
              <div class="element-name"></div>
              <div class="element-rating"></div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="recap-element">
              <div class="element-name"></div>
              <div class="element-rating"></div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="recap-element">
              <div class="element-name"></div>
              <div class="element-rating"></div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="recap-element">
              <div class="element-name"></div>
              <div class="element-rating"></div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-4 col-md-offset-4 collapse" id="btn-create">
            <button class="btn btn-block btn-create-idea">
              Write my ideas with these elements
            </button>
          </div>
        </div>
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>
</div>
@else
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-create">
    <div class="modal-content">
      <div class="modal-header text-center">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h2 class="modal-title text-uppercase">{{ $challenge->name }}</h2>
        <p>
          {{ $challenge->description }}
        </p>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-info text-center" role="alert">
              <h2><i class="material-icons">account_circle</i></h2>
              You must be logged in to create an idea
            </div>
          </div>    
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

  
@endsection
