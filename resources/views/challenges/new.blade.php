@extends('layouts.main')

@section('content')

<div class="row">
  <h2 class="text-center">New challenge</h2>
  <div class="container">
    @if (Session::has('message'))
    <div class="col-md-8 col-md-offset-2">
      <div class="alert alert-danger text-center">
        <i class="fa fa-exclamation-triangle fa-2x"></i><br/>
        {{ Session::get('message') }}
      </div>
    </div>   
    @endif
    
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>
  
</div>

<div class="container">
  <form action="{{ url('/challenges/new')}}" enctype="multipart/form-data" method="POST" class="form-horizontal">
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

        <div class="form-group hidden">
            <label class="col-sm-3 control-label">Image cover URL</label>

            <div class="col-sm-6">
              <input type="text" name="img_cover" class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">Image cover (from pc)</label>

            <div class="col-sm-6">
              <input type="file" name="cover" id="cover" accept="image/*">
            </div>
        </div>
        
        

        <div class="form-group">
            <label class="col-sm-3 control-label">Challenge brief</label>

            <div class="col-sm-6">
              <textarea rows="5" name="content" class="form-control" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="task-date" class="col-sm-2 col-sm-offset-1 control-label">Start date</label>

            <div class="col-sm-2">
              <input class="form-control calendar" placeholder="Start date of your challenge" id="start_date" name="start_date" data-altinput=true data-altFormat="F j, Y" required>
              <!-- <input type="text" name="start_date" class="form-control calendar" required> -->
            </div>
            
            <label for="task-date" class="col-sm-1 control-label">End date</label>

            <div class="col-sm-2">
              <input class="form-control calendar" placeholder="End date of your challenge" id="end_date" name="end_date" data-altinput=true data-altFormat="F j, Y" required>

              <!-- <input type="text" name="end_date" class="form-control calendar" required> -->
            </div>
        </div>

        <div class="form-group">
            
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
@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/1.8.7/flatpickr.min.js"></script>
  <script src="{{ asset('js/admin.js') }}"></script>
@endpush

@push('styles')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/1.8.7/flatpickr.min.css" rel="stylesheet">
@endpush

@endsection
