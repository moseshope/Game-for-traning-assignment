<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Challenges;
use App\Ideas;
use App\IdeasElements;
use App\User;
use DB;
use Auth;
use Log;

class IdeasController extends Controller
{

    protected $ideas;
    //RESTE A FAIRE: recuperer le challenge vu par l'user dans $challenge, pour recuperer ses idees
    //$challenge = Challenges::find($id);

    //retourne la liste des idées d'un challenge
    public function index(Request $request)
    {
        $ideas = Ideas::orderBy('created_at', 'desc')->get($challenge);
        $user = Auth::check();
        if (isset($user)){
          $isAdmin = $user->isAdmin;
        }
        else{
          $isAdmin = false;
        }

        return view('challenge.ideas.list', [
            'ideas' => $ideas,
            'isAdmin' => $isAdmin,
        ]);
    }

    public function detail($challenge, $idea)
    {
      $ideaElement = DB::table('ideas_elements')->where('ideas_elements.IDIdea', $idea)->join('ideas', 'ideas_elements.IDIdea', '=', 'ideas.IDIdea')->get();
      return $ideaElement;
      // return view('idea.detail', ['idea' => $idea]);
    }

    //retourne l'interface de création d'une nouvelle idée
    //manque: function "showStore"

    //sauvegarde d'un nouveau challenge
    /*En cours*/
    public function storeIdea(Request $request, $challenge)
    {

      $user = Auth::user();

      $challengeName = Challenges::where('id', $challenge)->value('name');

      $this->validate($request, [
          'title' => 'required|max:255',
          'content' => 'required|max:2500',
      ]);
      $first = Ideas::where('IDIdea', $request->rebound)->first();
      $idea = new Ideas;
      $idea->title = $request->title;
      $idea->content = $request->content;
      $idea->IDChallenge = $challenge;
      $idea->IDUser = $user->id;
      $idea->save();

      if($request->rebound == 'false')
      {
        $ideaelements = new IdeasElements;
        $ideaelements->IDIdea = $idea->IDIdea;
        $ideaelements->character = $request->character;
        $ideaelements->place = $request->place;
        $ideaelements->ressource = $request->ressource;
        $ideaelements->quest = $request->quest;
        $ideaelements->warning = $request->warning;
        $ideaelements->treasure = $request->treasure;
        $ideaelements->save();
        $idea->IDElements = $ideaelements->id;

      }else{
        $first->rebounds = $first->rebounds + 1;
        $idea->IDElements = $first->IDElements;
      }
      $first->save();
      $idea->save();



      return redirect(route('challenge_detail', $challengeName));
    }

    // public function upvote(Ideas $idea){
    //   DB::table('ideas_elements')->where('id', $IDIdea->id)->increment('votes');
    //   return redirect('/task/'.$task->id);
    // }

    public function rebound (Request $request){
      if(Auth::Check()){

        $idea = Ideas::where('IDIdea', $request->get('id'))->first();
        if(!$idea){
          return 'false';
        }

      //nouvelle idée et éléments
      $newIdea = new Ideas;
      $this->validate($request, [
          'title' => 'required|max:255',
          'content' => 'required|max:2500',
      ]);

      $newIdea->title = $request->title;
      $newIdea->content = $request->content;
      $newIdea->IDChallenge = $idea->IDChallenge;
      $newIdea->IDUser = Auth::user()->id;
      $newIdea->save();

      $ideaElements = IdeasElements::where('IDIdea', $idea->IDIdea)->first()->replicate();
      $ideaElements->save();
      return IdeasElements::where('IDIdea', $idea->IDIdea)->count() - 1;

      }
      else return false;
    }
}
