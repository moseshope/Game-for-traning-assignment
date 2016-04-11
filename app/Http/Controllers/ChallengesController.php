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

    public function index(Request $request)
    {
        $challenges = Challenges::orderBy('created_at', 'asc')->get();
        $user = Auth::user();
        $isAdmin = $user->isAdmin;
        return view('challenges.home', [
            'challenges' => $challenges,
            'isAdmin' => $isAdmin,
        ]);
    }
    
    public function detail($challenge)
    {  
      $challenge = Challenges::where('name', $challenge)->get();
      Log::info($challenge);
      return view('challenges.detail', ['challenge' => $challenge]);
    }
    
    public function create()
    {  
      $test = "Salut";
      return $test;
    }
}