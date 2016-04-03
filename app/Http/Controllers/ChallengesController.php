<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Challenges;
use DB;
use Log;

class ChallengesController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $challenges;
    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $challenges = DB::table('challenges')->get();
        Log::info($challenges);
        return view('challenges.home', [
            'challenges' => $challenges,
        ]);
    }
    
    public function detail($challenge)
    {  
      $challenge = DB::table('challenges')->where('name', $challenge)->get();
      Log::info($challenge);
      return view('challenges.detail', ['challenge' => $challenge]);
    }
}