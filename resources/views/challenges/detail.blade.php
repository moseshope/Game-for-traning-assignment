@extends('layouts.main')

@section('content')

<div class="row">
  @if (Storage::disk('covers')->has( $challenge->url . '.jpg' ))
  <div class="challenge-cover" style="background-image:url(../images/{{ $challenge->url . '.jpg' }})">
  @else
  <div class="challenge-cover" style="background-image:url({{$challenge->img_cover}})">
  @endif
    <div class="challenge-cover-filter"></div>
    <h2>{{ $challenge->name }}</h2>
    <h4>{{ $challenge->description }}</h4>
    <div class="time-left">
      @if ($challenge->status != 'closed')
      <span class="time-left-indic">0 days left</span>
      @else
      <span class="time-left-indic time-closed"><i class="fa fa-lock"></i> Challenge completed</span>
      @endif
      <div class="progress timeline" style="background-color:#fff" data-end-date="{{ $challenge->end_date }}" data-start-date="{{ $challenge->start_date }}">
        <div style="background-color:{{ $challenge->color }}; width:0%" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
          <span class="sr-only">60% Complete</span>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
    <div class="panel panel-overview row">
      @if ($challenge->status != 'closed')
      <div class="panel-overview-indics col-md-10">
      @else
      <div class="panel-overview-indics col-md-12">
      @endif
        <div class="row">
          <div class="col-xs-4 text-center indic">
            <img src="{{ asset('img/picto/ideas.svg') }}" class="icon-indic icon-fadein" width="45" alt="Ideas">
            <span class="indic-title"><strong class="counter" style="color:{{ $challenge->color }}">{{ count($ideas) }}</strong> Ideas</span>
          </div>
          <div class="col-xs-4 text-center indic">
            <img src="{{ asset('img/picto/users.svg') }}" class="icon-indic icon-fadein" width="55" alt="Ideas">
            <span class="indic-title"><strong class="counter" style="color:{{ $challenge->color }}">{{ $ideaNBUser }}</strong> Creatives</span>
          </div>
          <div class="col-xs-4 text-center indic" data-toggle="tooltip" data-placement="bottom"
                title="1 new idea = 10 points
1 rebound = 5 points
1 like = 1 point">
            <img src="{{ asset('img/picto/picto-jus2.svg') }}" class="icon-indic js-animate-points" width="55" alt="Ideas">
            <span class="indic-title"><strong class="counter" id="img-points" style="color:{{ $challenge->color }}">0</strong> OZ</span>
          </div>
        </div>

      </div>
      @if ($challenge->status != 'closed')
      <a data-toggle="modal" data-target="#modalCreate" class="nostyle btn-recap">
      <div style="background-color:{{ $challenge->color }}" class="panel-overview-create col-md-2 text-center">
          <i class="icon-indic material-icons">library_add</i>
          <span class="indic-title">create</span>
      </div>
      </a>
      @endif
    </div>
  </div>
</div>

<div class="row">

  <div class="container-fluid">

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fadein active" id="ideas">
        <!-- <div class="row">
          <div class="col-sm-4 col-sm-offset-8">
            <form class="form-inline">
              <div class="form-group pull-right form-filter">
                <label>Filter by</label>
                <select class="form-control">
                  <option>Last ideas</option>
                  <option>Most likes</option>
                  <option>Most rebounds</option>
                </select>
              </div>
            </form>
            <br/>
          </div>
        </div> -->
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <p class="text-center text-accroche">
              {{ $challenge->content }}
            </p>
          </div>
        </div>

        <div class="row" id="ideas-list">
          @foreach ($ideas as $idea)
          @if($idea->element)
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="panel panel-idea">
              <div class="panel-body">
                <h3 class="truncate">{{ $idea->title }}</h3>
                  <!-- <h3><a href="{{$idea->IDIdea}}">{{ $idea->title }}</a></h3> -->
                <p class="idea-content">
                  {{ $idea->content }}
                </p>
                <p class="tag-list">
                  <span class="idea-tag tag-character-{{ $idea->IDIdea}}">{{ $idea->element->character}}</span>
                  <span class="idea-tag tag-place-{{ $idea->IDIdea}}">{{ $idea->element->place}}</span>
                  <span class="idea-tag tag-ressource-{{ $idea->IDIdea}}">{{ $idea->element->ressource}}</span>
                  <span class="idea-tag tag-quest-{{ $idea->IDIdea}}">{{ $idea->element->quest}}</span>
                  <span class="idea-tag tag-warning-{{ $idea->IDIdea}}">{{ $idea->element->warning}}</span>
                  <span class="idea-tag tag-treasure-{{ $idea->IDIdea}}">{{ $idea->element->treasure}}</span>
                </p>
                <span class="user-idea pull-left"><i class="material-icons">account_circle</i>{{ $idea->name }}</span>
                <strong class="pull-right" data-toggle="tooltip" data-placement="bottom" title="Disruptivity level"><i style="color: {{ $challenge->color }}" class="fa fa-bolt fa-lg"></i> {{ $idea->element->disruptive}}</strong>
              </div>
              @if (isset($isAdmin) && $isAdmin == 1)
              <div class="panel-footer" data-id="{{$idea->IDIdea}}">
                  <div>
                    <a data-toggle="modal" data-target=".modal-delete-idea"  class="text-danger js-modal-delete"><i class="fa fa-times"></i> Delete this idea</a>
                  </div>
              </div>
              @endif
              
              <div class="panel-idea-stats">
                <div style="background-color:{{ $challenge->color }}" class="stat-container--like stat-container {{ Auth::check() && $challenge->status != 'closed' ? 'js-btn-votes' : '' }}" data-id='{{ $idea->IDIdea}}'>
                  @if( Auth::check() && $idea->votes()->where('IDUser', Auth::id())->first())
                  <i class="fa fa-heart"></i>
                  @else
                  <i data-target="#modalCreate" data-toggle="modal" class="fa fa-heart-o"></i>
                  @endif
                  <span class="stat-indic stat-indic-likes">{{ $idea->votes->count() }}</span>

                </div>
                <div style="background-color:{{ $challenge->color }}" class="stat-container--rebound stat-container js-btn-rebound" data-id='{{ $idea->IDIdea}}'>
                  <img class="rebound-picto svg" src="{{ asset('img/picto/rebond.svg') }}" />
                  <span class="stat-indic">{{ $idea->rebounds }}</span>
                </div>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>


      </div>
      <div role="tabpanel" class="tab-pane fade" id="results">
        No results yet
      </div>
    </div>

  </div>
</div>
@if ($challenge->status != 'closed')
@if (isset($userLogged) && $userLogged === true && $elementsCharacter->count() >=2 )
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-create">
    <div class="modal-content">
      <div class="ideas-create">
        <div class="left-col col-sm-6">
          <h3>1/2 - <strong>Compose the scenario</strong></h3>
          <div class="tab-content tabs-scenario">
            <div role="tabpanel" class="tab-pane fade in active tab-pane--active" id="tab-place">
              <p class="storygraph">"Imagine if you are  <strong class="text-lowercase">{{ $challenge->context or 'Default' }}</strong> in a specific context</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsLocation[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsLocation[0]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 text-center">
                  <br/>
                  or
                </div>
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsLocation[1]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsLocation[1]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-ressource">
              <p class="storygraph">"With this resource at your disposal...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsRessource[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsRessource[0]->difficulty }}<i class="fa fa-bolt"></i>
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
                      {{ $elementsRessource[1]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-quest">
              <p class="storygraph">"You would use to...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsQuest[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsQuest[0]->difficulty }}<i class="fa fa-bolt"></i>
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
                      {{ $elementsQuest[1]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-character">
              <p class="storygraph">"For this group of users...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsCharacter[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsCharacter[0]->difficulty }}<i class="fa fa-bolt"></i>
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
                      {{ $elementsCharacter[0]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-treasure">
              <p class="storygraph">"By this revenue option...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsPayment[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsPayment[0]->difficulty }}<i class="fa fa-bolt"></i>
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
                      {{ $elementsPayment[1]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="tab-danger">
              <p class="storygraph">"And what if...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>{{ $elementsDisruptive[0]->label }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      {{ $elementsDisruptive[0]->difficulty }}<i class="fa fa-bolt"></i>
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
                      {{ $elementsDisruptive[1]->difficulty }}<i class="fa fa-bolt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <br/><br/>
            <div class="col-sm-4 col-sm-offset-2">
              <button disabled="disabled" style="background-color:{{ $challenge->color }};-webkit-filter: grayscale(70%);filter: grayscale(70%);-moz-filter: grayscale(70%);-ms-filter: grayscale(70%);" class="btn btn-block btn-main btn-main--other js-btn-element-previous">Previous</button>
            </div>
            <div class="col-sm-4">
              <button style="background-color:{{ $challenge->color }}" class="btn btn-block btn-main js-btn-element-next">Next</button>
            </div>
          </div>

        </div>
        <div class="right-col col-sm-6">
          <br/>
          <h4><strong>Scenario</strong></h4>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="{{ asset('img/picto/location.svg') }}" alt="Location" />
            </div>
            <div class="panel panel-default panel-element panel-element--filling droppable0">
              <div class="panel-body">
                <div style="color:{{ $challenge->color }}" class="text-center placeholder-plus"><i class="fa fa-plus"></i></div>
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="{{ asset('img/picto/resource.svg') }}" alt="Resource" />
            </div>
            <div class="panel panel-default panel-element droppable1">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="{{ asset('img/picto/advantage.svg') }}" alt="Advantage" />
            </div>
            <div class="panel panel-default panel-element droppable2">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="{{ asset('img/picto/user.svg') }}" alt="Users" />
            </div>
            <div class="panel panel-default panel-element droppable3">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="{{ asset('img/picto/revenue-stream.svg') }}" alt="Revenue Stream" />
            </div>
            <div class="panel panel-default panel-element droppable4">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <div class="element-recap col-sm-6">
            <div class="icon-element">
              <img src="{{ asset('img/picto/game-changer.svg') }}" alt="Game Changer" />
            </div>
            <div class="panel panel-default panel-element droppable5">
              <div class="panel-body">
              </div>
              <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
              </div>
            </div>
          </div>
          <br/>
          <div class="row text-center pepper-gauge">
            <div class="col-xs-4 gauge-step" style="background-color: {{ $challenge->color }}">
              <i class="fa fa-bolt"></i> <span>Innovative</span>
            </div>
            <div class="col-xs-4 gauge-step" style="background-color: {{ $challenge->color }}">
              <i class="fa fa-bolt"></i><i class="fa fa-bolt"></i><span>Original</span>
            </div>
            <div class="col-xs-4 gauge-step" style="background-color: {{ $challenge->color }}">
              <i class="fa fa-bolt"></i><i class="fa fa-bolt"></i><i class="fa fa-bolt"></i><span>Disruptive</span>
            </div>
          </div>
          <div class="text-center">
            <br/>
            <button type="button" style="background-color:{{ $challenge->color }}" class="btn btn-main btn-main--disabled js-btn-switch-write" disabled="disabled">Let's go !</button>

          </div>

        </div>
      </div>
      <div class="ideas-propose" style="display:none">
        <div class="left-col col-sm-6">
          <h3>2/2 - <strong>Create an idea</strong></h3>
          <div>
            <br/><br/>
            <h4><strong>Scenario</strong></h4>
            <p class="storygraph text-left">
              Imagine if you are <strong class="text-lowercase">{{ $challenge->context }}</strong> in <span class="story story-location"></span> with <span class="story story-resource"></span> at your disposal. You would <span class="story story-advantage"></span> for this group of <span class="story story-user"></span> by this <span class="story story-revenue"></span> option. And what if you consider <span class="story story-game-changer"></span> ?
            </p>
            <button style="background-color:{{ $challenge->color }};-webkit-filter: grayscale(70%);filter: grayscale(70%);-moz-filter: grayscale(70%);-ms-filter: grayscale(70%);" class="btn btn-main btn-main--other js-modify-elements"><i class="fa fa-chevron-left"></i> &nbsp;Edit elements</button>
          </div>

        </div>
        <div class="right-col col-sm-6">
            <form action="{{ route('challenge_detail_process', $challenge->id)}}" method="POST">
            {{ csrf_field() }}
            <br/>
            <h4><strong>Idea</strong></h4>
            <textarea name="content" pattern=".{50,250}" placeholder="Now you have your scenario, so : which product or service would you imaginate to meet this challenge ?" required title="50 to 250 chars" class="form-control" rows="10"></textarea>

            <h4><strong>Idea title</strong></h4>
            <input type="text" name="title" placeholder="The name of your product or service" class="form-control" />

            <div class="hidden elements-form">
              <input type="hidden" name="place" />
              <input type="hidden" name="ressource" />
              <input type="hidden" name="quest" />
              <input type="hidden" name="character" />
              <input type="hidden" name="treasure" />
              <input type="hidden" name="warning" />
              <input type="hidden" name="rebound" value='false' />
              <input type="hidden" name="disruptive" />
            </div>
            <div class="text-center">
              <button style="background-color:{{ $challenge->color }}" type="submit" class="btn btn-main">Share my idea to the world !</button>
            </div>

          </form>
        </div>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


@else
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
  <div class="modal-dialog">
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
              You must be logged in to contribute to a challenge<br/>

              <a type="button" class="btn btn-link" data-toggle="modal" data-target=".modal-login">Log In</a>
              Or
              <a type="button" class="btn btn-link" data-toggle="modal" data-target=".modal-register">Register</a>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer text-center">
        <div class="row text-center">
          <button style="background-color:{{ $challenge->color }}; margin:10px" type="button" class="btn btn-main" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endif

@if (isset($isAdmin) && $isAdmin == 1)
<!-- Modal -->
<div class="modal fade modal-delete-idea"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger text-center" role="alert">
          <i class="fa fa-exclamation-triangle fa-2x"></i> <br/>Are you sure you want to delete this idea ?
        </div>
        <h4 class="idea-title-delete"></h4>
        <p class="idea-p-delete"></p>
        <small class="idea-user"></small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="" type="button" class="btn btn-danger js-delete-idea-button"><i class="fa fa-times"></i> Delete this idea</a>
      </div>
    </div>
  </div>
</div>
@endif


@endsection
