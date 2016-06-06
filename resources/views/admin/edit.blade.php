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
      
      <div class="col-md-4">
        <button class="btn btn-primary pull-right" onclick="$('form input').removeAttr('')"><i class="fa fa-save"></i> Save changes</button>
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

@endsection
