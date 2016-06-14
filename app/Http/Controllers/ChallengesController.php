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
      
      /*Get 2 Random Element from each category*/
      $elementsCharacter = Elements::where('IDChallenge', $challenge->id)->where('category', 'Character')->orderByRaw("RAND()")->take(2)->get();
      $elementsRessource = Elements::where('IDChallenge', $challenge->id)->where('category', 'Ressource')->orderByRaw("RAND()")->take(2)->get();
      $elementsLocation = Elements::where('IDChallenge', $challenge->id)->where('category', 'Location')->orderByRaw("RAND()")->take(2)->get();
      $elementsQuest = Elements::where('IDChallenge', $challenge->id)->where('category', 'Quest')->orderByRaw("RAND()")->take(2)->get();
      $elementsDisruptive = Elements::where('IDChallenge', $challenge->id)->where('category', 'Disruptive element')->orderByRaw("RAND()")->take(2)->get();
      $elementsPayment = Elements::where('IDChallenge', $challenge->id)->where('category', 'Payment')->orderByRaw("RAND()")->take(2)->get();
      
      /*Retrieve Ideas*/
      $ideas = Ideas::where('IDChallenge', $challenge->id)->join('ideas_elements', 'ideas.IDIdea', '=', 'ideas_elements.IDIdea')->join('users', 'users.id', '=', 'ideas.IDUser')->orderBy('ideas.created_at', 'desc')->get();
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
        $challenge->status = "staging";
        $challenge->color = $request->color;
        $challenge->save();
        
        // $element = new Elements;
        // $element->IDChallenge = $challenge->id;
        // $element->character_1 = $request->character_1;
        // $element->save();

        Log::info($challenge);
        return redirect('/admin');
    }
    
    
    /*En cours*/
    public function storeIdea(Request $request, $challenge)
    {  
      
      $user = Auth::user();

      $challengeName = Challenges::where('id', $challenge)->value('name');
      
      $this->validate($request, [
          'title' => 'required|max:255',
          'content' => 'required|max:2500',
      ]);
      
      $idea = new Ideas;
      $idea->title = $request->title;
      $idea->content = $request->content;
      $idea->IDChallenge = $challenge;
      $idea->IDUser = $user->id;
      $idea->save();

      
      $ideaelements = new IdeasElements;
      $ideaelements->IDIdea = $idea->id;;
      $ideaelements->character = $request->character;
      $ideaelements->place = $request->place;
      $ideaelements->ressource = $request->ressource;
      $ideaelements->quest = $request->quest;
      $ideaelements->warning = $request->warning;
      $ideaelements->treasure = $request->treasure;
      $ideaelements->save();
      
      
      return redirect('/challenge/' . $challengeName);
    }
    
}
