@extends('layouts.main')

@section('content')

<div class="row">
  <div class="challenge-cover" style="background-image:url({{$challenge->img_cover}})">
    <h2>{{ $challenge->name }}</h2>
    <h4>{{ $challenge->description }}</h4>

    <div class="time-left">
      <span class="time-left-indic">15 days left</span>
      <div style="background-color:{{ $challenge->color }}" class="progress">
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
            <img src="../img/picto/ideas.svg" class="icon-indic" width="45" alt="Ideas">
            <span class="indic-title"><strong style="color:{{ $challenge->color }}">{{ count($ideas) }}</strong> Ideas</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="../img/picto/people.svg" class="icon-indic" width="45" alt="Ideas">
            <span class="indic-title"><strong style="color:{{ $challenge->color }}">{{ $ideaNBUser }}</strong> Participants</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="../img/picto/points.svg" class="icon-indic" width="30" alt="Ideas">
            <span class="indic-title"><strong style="color:{{ $challenge->color }}">65</strong> img points</span>
          </div>
        </div>

      </div>
      <div style="background-color:{{ $challenge->color }}" class="panel-overview-create col-md-2 text-center">
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
      <li role="presentation"><a href="#brief" aria-controls="brief" role="tab" data-toggle="tab">Brief</a></li>
      <li role="presentation" class="active"><a href="#ideas" aria-controls="ideas" role="tab" data-toggle="tab">Ideas</a></li>
      <!-- <li role="presentation" class="disabled"><a href="#results" aria-controls="results" role="tab" data-toggle="tab">Results</a></li> -->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade " id="brief">
        <div class="row">
          <div class="col-md-offset-2 col-md-8">
            <h4>Status : <strong>{{ $challenge->status }}</strong></h4>
            <p>
              {{ $challenge->content }}
            </p>
          </div>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane fadein active" id="ideas">
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

          @foreach ($ideas as $idea)
          
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="panel panel-idea">
              <div class="panel-body">
                <h3><a href="{{ $challenge->name}}/{{$idea->IDIdea}}">{{ $idea->title }}</a></h3>
                  <!-- <h3><a href="{{$idea->IDIdea}}">{{ $idea->title }}</a></h3> -->
                <p>
                  {{ $idea->content }}
                </p>
                <p>
                  <span style="background-color:{{ $challenge->color }}" class="idea-tag">{{ $idea->character}}</span>
                  <span style="background-color:{{ $challenge->color }}" class="idea-tag">{{ $idea->place}}</span>
                  <span style="background-color:{{ $challenge->color }}" class="idea-tag">{{ $idea->ressource}}</span>
                  <span style="background-color:{{ $challenge->color }}" class="idea-tag">{{ $idea->quest}}</span>
                  <span style="background-color:{{ $challenge->color }}" class="idea-tag">{{ $idea->warning}}</span>
                  <span style="background-color:{{ $challenge->color }}" class="idea-tag">{{ $idea->treasure}}</span>
                </p>
                <span class="user-idea"><i class="material-icons">account_circle</i>{{ $idea->name }}</span>
              </div>
              <div class="panel-idea-stats">
                <div style="background-color:{{ $challenge->color }}" class="stat-container--like stat-container js-btn-votes" data-id='{{ $idea->id}}'>
                  <i class="fa fa-heart"></i>
                  <span class="stat-indic">{{ $idea->votes }}</span>
                  
                </div>
                <div style="background-color:{{ $challenge->color }}" class="stat-container--rebound stat-container js-btn-rebound" data-id='{{ $idea->id}}'>
                  <i class="fa fa-share"></i>
                  <span class="stat-indic">{{ App\IdeasElements::where('IDIdea', $idea->id)->count() }}</span>
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
      <div class="ideas-create">
        <div class="left-col col-sm-6">
          <h3>1/2 - <strong>Etablir le scénario</strong></h3>
          <div class="tab-content tabs-scenario">
            <div role="tabpanel" class="tab-pane fade in active tab-pane--active" id="tab-character">
              <p class="storygraph">"Your character is...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsCharacter[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsCharacter[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  ou
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsCharacter[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsCharacter[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-place">
              <p class="storygraph">"He is located in...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsLocation[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsLocation[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  ou
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsLocation[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsLocation[1]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-ressource">
              <p class="storygraph">"He uses...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsRessource[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsRessource[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  ou
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsRessource[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsRessource[1]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-quest">
              <p class="storygraph">"He must...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsQuest[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsQuest[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  ou
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsQuest[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsQuest[1]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-danger">
              <p class="storygraph">"But first he needs to defeat...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsDisruptive[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsDisruptive[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  ou
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsDisruptive[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsDisruptive[1]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-treasure">
              <p class="storygraph">"and he will earn...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsPayment[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsPayment[0]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  ou
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsPayment[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsPayment[1]->difficulty }}<i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <br/><br/>
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-block btn-main btn-main--other js-btn-element-previous">Précédent</button>
            </div>
            <div class="col-sm-4">
              <button class="btn btn-block btn-main js-btn-element-next">Suivant</button>
            </div>
          </div>

        </div>
        <div class="right-col col-sm-6">
          <br/>
          <h4><strong>Scénario</strong></h4>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="../img/picto/user.svg" alt="Character" />
            </div>
            <div class="panel panel-default panel-element panel-element--filling">
              <div class="panel-body">
                <div class="text-center placeholder-plus"><i class="fa fa-plus"></i></div>
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="../img/picto/location.svg" alt="Location" />
            </div>
            <div class="panel panel-default panel-element">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="../img/picto/resource.svg" alt="Resource" />
            </div>
            <div class="panel panel-default panel-element">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="../img/picto/advantage.svg" alt="Advantage" />
            </div>
            <div class="panel panel-default panel-element">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="../img/picto/game-changer.svg" alt="Game Changer" />
            </div>
            <div class="panel panel-default panel-element">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="../img/picto/revenue-stream.svg" alt="Revenue Stream" />
            </div>
            <div class="panel panel-default panel-element">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <br/>
          <div class="row text-center pepper-gauge">
            <div class="col-xs-4 gauge-step">
              <i class="material-icons">star</i> <span>Innovante</span>
            </div>
            <div class="col-xs-4 gauge-step">
              <i class="material-icons">star</i><i class="material-icons">star</i><span>Originale</span>
            </div>
            <div class="col-xs-4 gauge-step">
              <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i><span>Disruptive</span>
            </div>
          </div>
        </div>
      </div>
      <div class="ideas-propose" style="display:none">
        <div class="left-col col-sm-6">
          <h3>2/2 - <strong>Proposer une idée</strong></h3>
          <div>
            <br/><br/>
            <h4><strong>Scenario</strong></h4>
            <p class="storygraph text-left">
              Nam bibendum vehicula ligula, vel dapibus orci viverra eget. Curabitur eu tortor eu ipsum tempus ornare a id neque. Nullam aliquet tortor purus, a commodo ex tincidunt sit amet. Donec volutpat est vel ligula sagittis dictum. Pellentesque porta in ex non pulvinar.
            </p>
            <button class="btn btn-main btn-main--other js-modify-elements">Modifier</button>
          </div>

        </div>
        <div class="right-col col-sm-6">
            <form action="{{ route('challenge_detail_process', $challenge->id)}}" method="POST">
            {{ csrf_field() }}
            <br/>
            <h4><strong>Idea</strong></h4>
            <textarea name="content" pattern=".{50,250}" required title="50 to 250 chars" class="form-control" rows="10"></textarea>

            <h4><strong>Idea title</strong></h4>
            <input type="text" name="title" class="form-control" />

            <div class="hidden elements-form">
              <input type="hidden" name="character" />
              <input type="hidden" name="place" />
              <input type="hidden" name="ressource" />
              <input type="hidden" name="quest" />
              <input type="hidden" name="warning" />
              <input type="hidden" name="treasure" />
            </div>

            <button type="submit" class="btn btn-main">Publier mon idée !</button>

          </form>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-main btn-main--disabled js-btn-switch-write" disabled="disabled">Proposer une idée</button>
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
              You must be logged in to create an idea<br/>
              
              <a type="button" class="btn btn-link" data-toggle="modal" data-target=".modal-login">Log In</a>
              Or
              <a type="button" class="btn btn-link" data-toggle="modal" data-target=".modal-register">Register</a>
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
