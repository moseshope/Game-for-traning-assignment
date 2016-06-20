@extends('layouts.main')

@section('content')
<a href="{{ url('/admin/'.$challenge->id.'/export') }}" class="btn btn-primary">Export ideas</a>


<form action="{{ url('/admin/'.$challenge->id)}}" method="POST">
  {{ csrf_field() }}
  <div class="row">
    <div class="challenge-cover" style="background-image:url({{$challenge->img_cover}})">
      <br/>

      <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
          Name : <input type="text" name="name" class="form-control" value="{{ $challenge->name }}" />
        </div>
        <div class="form-group">
          Description : <input type="text" name="description" class="form-control" value="{{ $challenge->description }}" />
        </div>
        <div class="form-group">
          Cover : <input type="text" name="img_cover" class="form-control" value="{{ $challenge->img_cover }}" />
        </div>
      </div>

      <div class="col-md-4 text-right">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button><br/><br/>
        <button type="button" data-toggle="modal" data-target=".modal-elements" class="btn btn-info"><i class="fa fa-tags"></i> Manage elements</button><br/><br/>
        <button type="button" data-toggle="modal" data-target=".modal-status" class="btn btn-warning"><i class="fa fa-cog"></i> Change status</button><br/><br/>
        <button type="button" data-toggle="modal" data-target=".modal-color" class="btn btn-success"><i class="fa fa-paint-brush"></i> Change color</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-offset-2 col-md-8">
      <br/>
      <label>Brief</label>
      <textarea class="form-control" name="content" rows="12">{{ $challenge->content }}</textarea>
    </div>
  </div>

</form>



<!-- Modal Elements-->
<div class="modal fade modal-elements" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Elements</h4>
      </div>

        {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">

          <form action="/admin/{{ $challenge->id }}/context" method="POST">
            <div class="col-md-6">
              <h3>Edit context</h3>
              <div class="panel panel-default">
                <div class="panel-body">
                  <label>What if you were...</label>
                  <input type="text" name="context" value="{{ $challenge->context }}" class="form-control" />
                  <br/>
                  <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Save</button>
                </div>
              </div>
            </div>
          </form>

          <form action="{{ url('/admin/'.$challenge->id.'/elements') }}" method="POST">
            <div class="col-md-6">
              <h3>Add an element</h3>
              <div class="panel panel-default">
                <div class="panel-body">
                  <input type="text" class="form-control" placeholder="Element label" name="label">
                  <br/>
                  <div class="row">
                    <div class="col-md-6">
                      <label>Category</label>
                      <select name="category" class="form-control">
                        <option value="Character">Character</option>
                        <option value="Ressource">Ressource</option>
                        <option value="Location">Location</option>
                        <option value="Quest">Quest</option>
                        <option value="Disruptive element">Disruptive element</option>
                        <option value="Payment">Payment</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Difficulty</label>
                      <select name="difficulty" style="font-family:'FontAwesome', 'Lato'" class="form-control">
                        <option value="1">&#xf0e7;</option>
                        <option value="2">&#xf0e7; &#xf0e7;</option>
                        <option value="3">&#xf0e7; &#xf0e7; &#xf0e7;</option>
                      </select>
                      <br/>
                      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Save element</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </form>
          </div>


          <br/>

          <div>

              <div class="col-md-4">
                <ul class="list-group" style="overflow-y: auto;height: 300px;">
                  <li class="list-group-item active text-uppercase">Characters</li>
                  @foreach ($elementsCharacter as $elementCharacter)
                  <li class="list-group-item">
                    <form style="display:inline-block" action="/admin/{{ $elementCharacter->id }}/delete" method="POST">
                      <button type="submit" class="btn btn-link btn-remove"><i class="fa fa-times"></i></button>
                    </form>
                     {{ $elementCharacter->label }} <span class="badge"><i class="fa fa-star"></i>{{ $elementCharacter->difficulty }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>

              <div class="col-md-4">
                <ul class="list-group" style="overflow-y: auto;height: 300px;">
                  <li class="list-group-item active text-uppercase">Ressource</li>
                  @foreach ($elementsRessource as $elementRessource)
                  <li class="list-group-item">
                    <form style="display:inline-block" action="/admin/{{ $elementRessource->id }}/delete" method="POST">
                      <button type="submit" class="btn btn-link btn-remove"><i class="fa fa-times"></i></button>
                    </form>
                    {{ $elementRessource->label }} <span class="badge"><i class="fa fa-star"></i>{{ $elementRessource->difficulty }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>

              <div class="col-md-4">
                <ul class="list-group" style="overflow-y: auto;height: 300px;">
                  <li class="list-group-item active text-uppercase">Locations</li>
                  @foreach ($elementsLocation as $elementLocation)
                  <li class="list-group-item">
                    <form style="display:inline-block" action="/admin/{{ $elementLocation->id }}/delete" method="POST">
                      <button type="submit" class="btn btn-link btn-remove"><i class="fa fa-times"></i></button>
                    </form>
                    {{ $elementLocation->label }} <span class="badge"><i class="fa fa-star"></i>{{ $elementLocation->difficulty }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>

              <div class="col-md-4">
                <ul class="list-group" style="overflow-y: auto;height: 300px;">
                  <li class="list-group-item active text-uppercase">Quest</li>
                  @foreach ($elementsQuest as $elementQuest)
                  <li class="list-group-item">
                    <form style="display:inline-block" action="/admin/{{ $elementQuest->id }}/delete" method="POST">
                      <button type="submit" class="btn btn-link btn-remove"><i class="fa fa-times"></i></button>
                    </form>
                    {{ $elementQuest->label }} <span class="badge"><i class="fa fa-star"></i>{{ $elementQuest->difficulty }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>

              <div class="col-md-4">
                <ul class="list-group" style="overflow-y: auto;height: 300px;">
                  <li class="list-group-item active text-uppercase">Disruptive elements</li>
                  @foreach ($elementsDisruptive as $elementDisruptive)
                  <li class="list-group-item">
                    <form style="display:inline-block" action="/admin/{{ $elementDisruptive->id }}/delete" method="POST">
                      <button type="submit" class="btn btn-link btn-remove"><i class="fa fa-times"></i></button>
                    </form>
                    {{ $elementDisruptive->label }} <span class="badge"><i class="fa fa-star"></i>{{ $elementDisruptive->difficulty }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>

              <div class="col-md-4">
                <ul class="list-group" style="overflow-y: auto;height: 300px;">
                  <li class="list-group-item active text-uppercase">Payment</li>
                  @foreach ($elementsPayment as $elementPayment)
                  <li class="list-group-item">
                    <form style="display:inline-block" action="/admin/{{ $elementPayment->id }}/delete" method="POST">
                      <button type="submit" class="btn btn-link btn-remove"><i class="fa fa-times"></i></button>
                    </form>
                    {{ $elementPayment->label }} <span class="badge"><i class="fa fa-star"></i>{{ $elementPayment->difficulty }}</span>
                  </li>
                  @endforeach
                </ul>
              </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
</div>
  <!-- Modal -->
  <div class="modal fade modal-status" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Change status</h4>
        </div>
        <form action="{{ url('/admin/'.$challenge->id.'/status')}}" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="alert alert-warning" role="alert">
              <i class="fa fa-exclamation-triangle"></i>
              Attention, passer le status en "Live" va le faire apparaitre dans la liste des challenges
            </div>
            <select name="status" class="form-control">
              @if ($challenge->status == 'closed')
              <option value="closed" selected>Closed</option>
              <option value="staging">Staging</option>
              <option value="live">Live</option>
              @elseif ($challenge->status == 'staging')
              <option value="closed" >Closed</option>
              <option value="staging" selected>Staging</option>
              <option value="live">Live</option>
              @elseif ($challenge->status == 'live')
              <option value="closed" >Closed</option>
              <option value="staging">Staging</option>
              <option value="live" selected>Live</option>
              @else
              <option value="closed" >Closed</option>
              <option value="staging">Staging</option>
              <option value="live">Live</option>
              @endif
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade modal-color" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Change color</h4>
        </div>
        <form action="/admin/{{ $challenge->id }}/color" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group row text-center">
              <div class="col-sm-12">
                <input type="hidden" class="challenge-color" value="{{ $challenge->color }}" name="color" />
                <label>Current Color</label>
                <div class="text-center current-color" style="background-color:{{ $challenge->color }}"></div>
                <label>Choose color</label>
                <div class="row">
                  <ul class="color-list">
                    <li class="selected" data-color="#F44336"></li>
                    <li data-color="#2196F3"></li>
                    <li data-color="#8BC34A"></li>
                    <li data-color="#009688"></li>
                    <li data-color="#673AB7"></li>
                    <li data-color="#CDDC39"></li>
                    <li data-color="#FFC107"></li>
                    <li data-color="#607D8B"></li>
                    <li data-color="#795548"></li>
                    <li data-color="#E91E63"></li>
                  </ul>
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
