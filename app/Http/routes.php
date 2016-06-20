<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::get('/', function () {
      return redirect('/challenges');
  })->middleware('guest');


  Route::get('/home', function () {
    return redirect('/challenges');
  });

  /*ADMIN*/
  Route::get('/admin', 'AdminController@index');
  Route::get('/admin/{challenge}', array('as' => 'challenge_edit', 'uses' => 'AdminController@showEdit' ));
  Route::post('/admin/{challengeID}', 'AdminController@edit');
  Route::post('/admin/{challengeID}/status', 'AdminController@editStatus');
  Route::post('/admin/{challengeID}/color', 'AdminController@editColor');
  Route::post('/admin/{challengeID}/context', 'AdminController@editContext');
  Route::post('/admin/{challengeID}/elements', 'AdminController@storeElements');
  Route::post('/admin/{elementID}/delete', 'AdminController@deleteElement');

  
  /*CHALLENGES*/
  Route::get('/challenges', 'ChallengesController@index');
  Route::get('/challenges/new', 'ChallengesController@showStore');
  Route::post('/challenges/new', 'ChallengesController@store');
  Route::get('/challenges/{challenge}', array('as' => 'challenge_detail', 'uses' => 'ChallengesController@detail' ));


  /*Ideas*/
    Route::get('/challenge/{challenge}/{idea}', 'IdeasController@detail');
    Route::post('/challenge/{challengeID}', array('as' => 'challenge_detail_process', 'uses' => 'IdeasController@storeIdea' ));

    /*Rebound*/

    Route::post ('api/challenge/rebound', array ('as' => 'challenge_detail_rebound', 'uses' => 'IdeasController@rebound'));


  // Route::get('/ideas', 'IdeasController@index');
  // Route::get('/ideas/new', 'IdeasController@showStore');
  // Route::post('/ideas/new', 'IdeasController@store');
  // Route::get('/idea/{ideaID}', 'IdeasController@detail');

  Route::auth();

  /*Votes*/
  Route::post('api/challenge/vote',  array('as' => 'challenge_vote', 'uses' => 'VotesController@vote' ));
  // Route::post('/challenge/{challenge}', 'VotesController@upvote');
});
