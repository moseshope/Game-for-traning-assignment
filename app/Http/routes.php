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
      return view('auth.login');
  })->middleware('guest');

  Route::get('/home', 'HomeController@index');


  /*CHALLENGES*/
  Route::get('/challenges', 'ChallengesController@index');
  Route::get('/challenges/new', 'ChallengesController@showStore');
  Route::post('/challenges/new', 'ChallengesController@store');
  Route::get('/challenge/{challenge}', 'ChallengesController@detail');
  Route::post('/challenge/{challengeID}', 'ChallengesController@storeIdea');

  /*Ideas*/
  Route::get('/challenge/{challenge}/{idea}', 'IdeasController@detail');

  // Route::get('/ideas', 'IdeasController@index');
  // Route::get('/ideas/new', 'IdeasController@showStore');
  // Route::post('/ideas/new', 'IdeasController@store');
  // Route::get('/idea/{ideaID}', 'IdeasController@detail');

  Route::auth();

  /*Votes*/
  Route::get('/challenge/{challenge}', 'VotesControllers@totalVotes');
  Route::post('/challenge/{challenge}', 'VotesController@upvote');
  Route::post('/challenge/{challenge}', 'VotesController@unvote');
});
