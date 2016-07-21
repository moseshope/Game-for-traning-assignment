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

// Route::group(['middleware' => ['web']], function () {
  Route::get('/', 'ChallengesController@index')->middleware('guest');
  
  Route::get('/lang/{lang}', 'LanguageController@setLang');
  
  Route::get('/about', function()
  {
      return view('about.about');
  });
  
  Route::get('/profile', function()
  {
    return view('auth.passwords.email');
  });


  /*ADMIN*/
  Route::get('/admin', 'AdminController@index');
  Route::get('/admin/{challengeUrl}', array('as' => 'challenge_edit', 'uses' => 'AdminController@showEdit' ));
  Route::post('/admin/{challengeID}', 'AdminController@edit');
  Route::post('/admin/{challengeID}/status', 'AdminController@editStatus');
  Route::post('/admin/{challengeID}/color', 'AdminController@editColor');
  Route::post('/admin/{challengeID}/editCover', 'AdminController@editCover');
  Route::post('/admin/{challengeID}/context', 'AdminController@editContext');
  Route::post('/admin/{challengeID}/elements', 'AdminController@storeElements');
  Route::post('/admin/{elementID}/delete', 'AdminController@deleteElement');
  Route::get('/admin/{userID}/rights', 'AdminController@rightsAdmin');
  Route::get('/admin/{ideaID}/delete', 'AdminController@deleteIdea');
  Route::get('/admin/{challengeID}/deleteChallenge', 'AdminController@deleteChallenge');
  
  /*export ideas*/
  Route::get('/admin/{challengeID}/export', 'AdminController@export');


  /*CHALLENGES*/
  Route::get('/challenges', 'ChallengesController@index');
  Route::get('/challenges/new', 'ChallengesController@showStore');
  Route::post('/challenges/new', 'ChallengesController@store');
  Route::get('/challenges/{challengeUrl}', array('as' => 'challenge_detail', 'uses' => 'ChallengesController@detail' ));
  Route::get('/cover/{coverimage}', [
    'uses' => 'ChallengesController@coverImage',
    'as' => 'challenge.coverImage'
  ]);
  
  Route::get('images/{image}', function($image = null)
  {
      $path = storage_path().'/app/covers/' . $image;
      if (file_exists($path)) { 
          return Response::download($path);
      }
  });


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
// });
