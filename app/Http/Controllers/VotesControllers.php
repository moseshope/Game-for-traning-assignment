<?php
namespace App\Http\Votes;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ideas;
use App\User;
use DB;
use Auth;

class VotesControllers extends Controller{

  public function totalVotes($idea){
    $votes = Votes::where('IDIdea', $idea->IDIdea)->count();
    return $votes;
  }

  public function upvote($idea, $user)
    {
      if (Auth::check())
      {
        DB::table('votes')->insert(
        {
          ['IDIdea'=>'$idea->IDIdea','IDUser'=>'$user->IDUser']
        }
    }
    }

    public function unvote($idea, $user){
      if (Auth::check())
      {
        $ids=['IDIdea'=>'$idea->IDIdea','IDUser'=>'$user->IDUser'];
        DB::table('votes')->where($ids)->delete();
    }
    }
  }
