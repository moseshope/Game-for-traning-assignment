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

          <!-- <div class="col-lg-4 col-md-6 col-sm-6">
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
          </div> -->

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
                  <span class="idea-tag">{{ $idea->character}}</span>
                  <span class="idea-tag">{{ $idea->place}}</span>
                  <span class="idea-tag">{{ $idea->ressource}}</span>
                  <span class="idea-tag">{{ $idea->quest}}</span>
                  <span class="idea-tag">{{ $idea->warning}}</span>
                  <span class="idea-tag">{{ $idea->treasure}}</span>
                </p>
                <span class="user-idea pull-right"><i class="material-icons">account_circle</i>{{ $idea->name }}</span>
              </div>
              <div class="panel-idea-stats">
                <div class="stat-container--like stat-container js-btn-votes" data-id={{ $idea->id}}>
                  <i class="fa fa-heart"></i>
                  <span class="stat-indic">{{ $idea->votes->count()}}</span>
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

@if (isset($userLogged) && $userLogged === true && isset($elements))
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
                      <strong>{{ $elements->character_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i>
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
                      <strong>{{ $elements->character_2 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->location_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->location_2 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->power_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->power_2 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->goal_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->goal_2 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->warning_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->warning_2 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->prize_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>{{ $elements->prize_1 }}</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
              <i class="material-icons">face</i>
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
              <i class="material-icons">place</i>
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
              <i class="material-icons">battery_charging_full</i>
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
              <i class="material-icons">flag</i>
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
              <i class="material-icons">warning</i>
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
              <i class="material-icons">stars</i>
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
          <div class="tab-content tabs-scenario">
            <div role="tabpanel" class="tab-pane fade in active tab-pane--active" id="tab-character">
              <p class="storygraph">Nam bibendum vehicula ligula, vel dapibus orci viverra eget. Curabitur eu tortor eu ipsum tempus ornare a id neque. Nullam aliquet tortor purus, a commodo ex tincidunt sit amet. Donec volutpat est vel ligula sagittis dictum. Pellentesque porta in ex non pulvinar.
              </p>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tab-place">
              <p class="storygraph">"He is located in...</p>
              <div class="row">
                <div class="col-sm-5">
                  <div class="panel panel-default panel-element">
                    <div class="panel-body">
                      <strong>Gotham</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>New York City</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>The power of friendship</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>Drug money $$</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>Create a rainbow dispenser</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>Save a princess</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>A dragon</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>Guy Roux</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>One million dollar</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
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
                      <strong>Eternal life</strong>
                    </div>
                    <div class="panel-footer text-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difficulty of the element">
                      <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

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
            <textarea name="content" pattern=".{50,250}" required title="50 to 250 chars" class="form-control" rows="10">Test</textarea>

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

            <button type="submit" class="btn btn-main">Proposer une idée</button>

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
