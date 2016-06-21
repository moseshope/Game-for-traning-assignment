<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ideas;
use App\User;
use App\Votes;
use DB;
use Auth;

class VotesController extends Controller{

  public function totalVotes($idIdea){
    return Votes::where('IDIdea', $idIdea)->count();
  }

  public function vote(Request $request)
    {
      if (Auth::check())
      {
        $vote = Auth::user()->vote()->where('IDIdea', $request->get('id'))->first();
        if($vote)
        {
          $vote->delete();
        }
        else
        {
          DB::table('votes')->insert(
            ['IDIdea'=> $request->get('id'),'IDUser'=> Auth::id()]
          );
        }
      }
      return $this->totalVotes($request->get('id'));
    }
  }
