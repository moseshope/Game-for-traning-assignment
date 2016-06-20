@extends('layouts.main')

@section('content')

<div class="row">
  <h2 class="text-center">New challenge</h2>
</div>

<div class="container">
  <form action="{{ url('/challenges/new')}}" method="POST" class="form-horizontal">
    <!-- Nav tabs -->

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="challenge">
        {{ csrf_field() }}
        <br/>
        <!-- Task Name -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">Challenge</label>

            <div class="col-sm-6">
                <input type="text" name="name"  class="form-control" required value="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Challenge description</label>

            <div class="col-sm-6">
              <textarea rows="2" name="description" class="form-control" required></textarea>
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
              <textarea rows="5" name="content" class="form-control" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="task-date" class="col-sm-3 control-label">Start date</label>

            <div class="col-sm-6">
              <input type="date" name="start_date" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="task-date" class="col-sm-3 control-label">End date</label>

            <div class="col-sm-6">
              <input type="date" name="end_date" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Challenge color</label>
          <div class="col-sm-6">
            <input type="hidden" class="challenge-color" value="#333" name="color" />
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




      <!-- Add Task Button -->
      <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
              <button type="submit" class="btn btn-main">
                  <i class="fa fa-btn fa-plus"></i> Create challenge
              </button>
          </div>
      </div>
  </form>

</div>
@endsection
