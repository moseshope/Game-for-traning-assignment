@extends('layouts.main')

@section('content')
  
<div class="row">
  <h2 class="text-center">New challenge</h2>
</div>

<div class="container">
  <form action="/challenges/new" method="POST" class="form-horizontal">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#challenge" aria-controls="challenge" role="tab" data-toggle="tab">Challenge</a></li>
      <li role="presentation"><a href="#elements" aria-controls="elements" role="tab" data-toggle="tab">Elements</a></li>
    </ul>
  
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
      
      </div>
      <div role="tabpanel" class="tab-pane" id="elements">
        <br/>
        <div class="form-group-elements">
          <p>
            <img src="../img/picto/user.svg" alt="Character" />
          </p>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Hero n°1</label>
              <input type="text" class="form-control" required name="character_1" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Hero n°2</label>
              <input type="text" class="form-control" required name="character_2" >
            </div>
          </div>
        </div>
        <div class="form-group-elements">
          <p>
            <img src="../img/picto/location.svg" alt="Location" />
          </p>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Location n°1</label>
              <input type="text" class="form-control" required name="location_1" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Location n°2</label>
              <input type="text" class="form-control" required name="location_2" >
            </div>
          </div>
        </div>
        <div class="form-group-elements">
          <p>
            <img src="../img/picto/resource.svg" alt="Resource" />
          </p>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Power n°1</label>
              <input type="text" class="form-control" required name="power_1" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Power n°2</label>
              <input type="text" class="form-control" required name="power_2" >
            </div>
          </div>
        </div>
        <div class="form-group-elements">
          <p>
            <img src="../img/picto/advantage.svg" alt="Advantage" />
          </p>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Goal n°1</label>
              <input type="text" class="form-control" required name="goal_1" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Goal n°2</label>
              <input type="text" class="form-control" required name="goal_2" >
            </div>
          </div>
        </div>
        <div class="form-group-elements">
          <p>
            <img src="../img/picto/game-changer.svg" alt="Game Changer" />
          </p>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Warning °1</label>
              <input type="text" class="form-control" required name="warning_1" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Warning n°2</label>
              <input type="text" class="form-control" required name="warning_2" >
            </div>
          </div>
        </div>
        <div class="form-group-elements">
          <p>
            <img src="../img/picto/revenue-stream.svg" alt="Revenue Stream" />
          </p>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Prize n°1</label>
              <input type="text" class="form-control" required name="prize_1" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Prize n°2</label>
              <input type="text" class="form-control" required name="prize_2" >
            </div>
          </div>
        </div>
      
        
      
      </div>
      <div role="tabpanel" class="tab-pane" id="messages">...</div>
      <div role="tabpanel" class="tab-pane" id="settings">...</div>
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
