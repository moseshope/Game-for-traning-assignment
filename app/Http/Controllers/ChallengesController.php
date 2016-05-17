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

class ChallengesController extends Controller
{

    protected $challenges;

    //retourne la liste des challenges
    public function index(Request $request)
    {
        $challenges = Challenges::orderBy('created_at', 'desc')->get();
        $user = Auth::user();
        
        if (isset($user)){
          $isAdmin = $user->isAdmin;
        }
        else{
          $isAdmin = false;
        }
        
        

        return view('challenges.home', [
            'challenges' => $challenges,
            'isAdmin' => $isAdmin,
        ]);
    }

    //retourne le detail d'un challenge
    public function detail($challenge)
    {  
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $userLogged = true;
      }
      else{
        $userLogged = false;
      }
      $challenge = Challenges::where('name', $challenge)->first();
      
      /*Retrieve Ideas*/
      $ideas = Ideas::where('IDChallenge', $challenge->id)->join('ideas_elements', 'ideas.IDIdea', '=', 'ideas_elements.IDIdea')->join('users', 'users.id', '=', 'ideas.IDUser')->orderBy('ideas.created_at', 'desc')->get();
      $ideaNBUser = $ideas->groupBy('IDUser')->count();
    // 
    // return $ideas;
      
      return view('challenges.detail', [
        'challenge' => $challenge,
        'userLogged' => $userLogged,
        'ideas' => $ideas,
        'ideaNBUser' => $ideaNBUser,
      ]);
    }

    //retourne le volet de création d'un nouveau challenge
    public function showStore(Request $request)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $isAdmin = $user->isAdmin;

        if ($isAdmin == 1){
          return view('challenges.new');
        }
        else{
          return redirect('/challenges');
        }
      }
      else{
        return redirect('/challenges');
      }
    }

    //sauvegarde d'un nouveau challenge
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
            'content' => 'required|max:20000',
            'img_cover' => 'max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $challenge = new Challenges;
        $challenge->name = $request->name;
        $challenge->url = str_slug($challenge->name, "-");
        $challenge->description = $request->description;
        $challenge->content = $request->content;
        $challenge->img_cover = $request->img_cover;
        $challenge->start_date = $request->start_date;
        $challenge->end_date = $request->end_date;
        $challenge->save();

        Log::info($challenge);
        return redirect('/challenges');
    }
        
}
