@extends('layouts.main')

@section('content')
  
<div class="row">
  <h2 class="text-center">New challenge</h2>
</div>

<div class="row">
  <form action="/challenges/new" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <!-- Task Name -->
      <div class="form-group">
          <label for="task-name" class="col-sm-3 control-label">Challenge</label>

          <div class="col-sm-6">
              <input type="text" name="name"  class="form-control" value="">
          </div>
      </div>
      
      <div class="form-group">
          <label class="col-sm-3 control-label">Challenge description</label>

          <div class="col-sm-6">
            <textarea rows="2" name="description" class="form-control"></textarea>
          </div>
      </div>
      
      <div class="form-group">
          <label class="col-sm-3 control-label">Image cover URL</label>

          <div class="col-sm-6">
            <input type="text" name="img_cover" class="form-control">
          </div>
      </div>
      
      <div class="form-group">
          <label class="col-sm-3 control-label">Challenge brief</label>

          <div class="col-sm-6">
            <textarea rows="5" name="content" class="form-control"></textarea>
          </div>
      </div>
      
      <div class="form-group">
          <label for="task-date" class="col-sm-3 control-label">Start date</label>

          <div class="col-sm-6">
            <input type="date" name="start_date" class="form-control">
          </div>
      </div>
      
      <div class="form-group">
          <label for="task-date" class="col-sm-3 control-label">End date</label>

          <div class="col-sm-6">
            <input type="date" name="end_date" class="form-control">
          </div>
      </div>
      
      <!-- Add Task Button -->
      <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
              <button type="submit" class="btn btn-default">
                  <i class="fa fa-btn fa-plus"></i>Add Task
              </button>
          </div>
      </div>
  </form>

</div>  
@endsection
