<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Challenges;
use App\Ideas;
use App\Elements;
use App\IdeasElements;
use App\User;
use DB;
use Auth;
use Storage;
use File;
use Session;
use Redirect;
// use Input as Input;
use Log;

class ChallengesController extends Controller
{

    protected $challenges;

    //retourne la liste des challenges
    public function index(Request $request)
    {
        $challenges = Challenges::orderBy('created_at', 'desc')->get();

        $stats = DB::table('ideas')->select(DB::raw('count(*) as total, IDChallenge'))->groupBy('IDChallenge')->get();

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
            'stats' => $stats,
        ]);
    }

    //retourne le detail d'un challenge
    public function detail($challengeUrl)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $userLogged = true;
        $isAdmin = $user->isAdmin;
      }
      else{
        $userLogged = false;
        $isAdmin = false;
      }

      $challenge = Challenges::where('url', $challengeUrl)->first();
      
      if ($challenge->status == "closed"){
        $ideas = Ideas::where('IDChallenge', $challenge->id)->join('users', 'users.id', '=', 'ideas.IDUser')->orderBy('ideas.created_at', 'desc')->get();
        $ideaNBUser = $ideas->groupBy('IDUser')->count();
        $topIdeas = Ideas::where('IDChallenge', $challenge->id)->join('users', 'users.id', '=', 'ideas.IDUser')->orderBy('ideas.totalVotes', 'desc')->take(3)->get();
              
        return view('challenges.detail', [
          'challenge' => $challenge,
          'userLogged' => $userLogged,
          'ideas' => $ideas,
          'ideaNBUser' => $ideaNBUser,
          'isAdmin' => $isAdmin,
          'topIdeas' => $topIdeas,
        ]);
      }
      else{
        /*Get 2 Random Element from each category*/
        $elementsCharacter = Elements::where('IDChallenge', $challenge->id)->where('category', 'Character')->orderByRaw("RAND()")->take(2)->get();
        $elementsRessource = Elements::where('IDChallenge', $challenge->id)->where('category', 'Ressource')->orderByRaw("RAND()")->take(2)->get();
        $elementsLocation = Elements::where('IDChallenge', $challenge->id)->where('category', 'Location')->orderByRaw("RAND()")->take(2)->get();
        $elementsQuest = Elements::where('IDChallenge', $challenge->id)->where('category', 'Quest')->orderByRaw("RAND()")->take(2)->get();
        $elementsDisruptive = Elements::where('IDChallenge', $challenge->id)->where('category', 'Disruptive element')->orderByRaw("RAND()")->take(2)->get();
        $elementsPayment = Elements::where('IDChallenge', $challenge->id)->where('category', 'Payment')->orderByRaw("RAND()")->take(2)->get();
      
        /*Retrieve Ideas*/
        $ideas = Ideas::where('IDChallenge', $challenge->id)->join('users', 'users.id', '=', 'ideas.IDUser')->orderBy('ideas.created_at', 'desc')->get();
        // $ideas = Ideas::where('IDChallenge', $challenge->id)->join('users', 'users.id', '=', 'ideas.IDUser')->join('ideas_elements', 'ideas_elements.IDIdea', '=', 'ideas.IDIdea')->orderBy('ideas.created_at', 'desc')->get();

        $ideaNBUser = $ideas->groupBy('IDUser')->count();

        return view('challenges.detail', [
          'challenge' => $challenge,
          'userLogged' => $userLogged,
          'ideas' => $ideas,
          'elementsCharacter' => $elementsCharacter,
          'elementsRessource' => $elementsRessource,
          'elementsLocation' => $elementsLocation,
          'elementsQuest' => $elementsQuest,
          'elementsDisruptive' => $elementsDisruptive,
          'elementsPayment' => $elementsPayment,
          'ideaNBUser' => $ideaNBUser,
          'isAdmin' => $isAdmin,
        ]);
      }    
      
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
            'name' => 'required|max:30',
            'description' => 'required|max:140',
            'content' => 'required|max:300',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        
        $challenge = new Challenges;
        $challenge->name = $request->name;
        
        /*check if already exist*/
        $challenge->url = str_slug($challenge->name, "-");
        $checkURL = Challenges::where('url', $challenge->url)->first();
        if (isset($checkURL)){
          Session::flash('message', "Challenge name already taken");
          return Redirect::back();
        }
        else{
          $challenge->description = $request->description;
          $challenge->content = $request->content;
          $challenge->img_cover = $request->img_cover;
          $challenge->start_date = $request->start_date;
          $challenge->end_date = $request->end_date;
          $challenge->status = "staging";
          $challenge->color = $request->color;
          $challenge->save();
          
          $file = $request->file('cover');
          $filename = $challenge->id . '_' . $challenge->url . '.jpg';
          
          if ($file){
            Storage::disk('covers')->put($filename, File::get($file));
          }
  
          Log::info($challenge);
          return redirect('/admin');
        }
        
        
        
    }
    
    public function coverImage($filename){
      $file = Storage::disk('covers')->get($filename);
      return new Response($file, 200);
    }

}
