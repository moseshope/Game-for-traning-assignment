<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Challenges;
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
<<<<<<< HEAD
    {  
      $challenge = Challenges::where('name', $challenge)->first();
=======
    {
      $challenge = Challenges::where('name', $challenge)->get();
>>>>>>> origin/BDD
      Log::info($challenge);
      return view('challenges.detail', ['challenge' => $challenge]);
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
<<<<<<< HEAD
      
=======


>>>>>>> origin/BDD
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
        $challenge->description = $request->description;
        $challenge->content = $request->content;
        $challenge->img_cover = $request->img_cover;
        $challenge->start_date = $request->start_date;
        $challenge->end_date = $request->end_date;
        $challenge->save();

        Log::info($challenge);
        return redirect('/challenges');
    }
<<<<<<< HEAD
    
    public function createIdea($challenge)
    {  
      $challenge = Challenges::where('name', $challenge)->get();
      Log::info($challenge);
      return $challenge;
    }
    
}
=======

    public function getId()
    {
      // renvoie l'id du challenge ou l'on se situe
    }
}
>>>>>>> origin/BDD
