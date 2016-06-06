@extends('layouts.main')

@section('content')
<form action="/admin/{{ $challenge->id }}" method="POST">
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
        <a class="btn btn-info"><i class="fa fa-tags"></i> Manage elements</a><br/><br/>
        <a data-toggle="modal" data-target=".modal-status" class="btn btn-warning"><i class="fa fa-cog"></i> Change status</a>
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
  
  <!-- Modal -->
  <div class="modal fade modal-status" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Change status</h4>
        </div>
        <form action="/admin/{{ $challenge->id }}/status" method="POST">
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

@endsection
