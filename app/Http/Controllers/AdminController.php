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

class AdminController extends Controller
{

    protected $challenges;

    //retourne la liste des challenges
    public function index()
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $isAdmin = $user->isAdmin;

        if ($isAdmin == 1){
          $challenges = Challenges::orderBy('created_at', 'desc')->get();
          
          $challengesNB = Challenges::count();
          $usersNB = User::count();
          $ideasNB = Ideas::count();
          
          return view('admin.home', [
            'challenges' => $challenges,
            'challengesNB' => $challengesNB,
            'usersNB' => $usersNB,
            'ideasNB' => $ideasNB,
          ]);
        }
        else{
          return redirect('/');
        }
      }
      else{
        return redirect('/');
      }
    }
    
    public function showEdit($challenge)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $isAdmin = $user->isAdmin;

        if ($isAdmin == 1){
          $challenge = Challenges::where('name', $challenge)->first();
          
          $elements = Elements::where('IDChallenge', $challenge->id)->get();
          
          $elementsCharacter = Elements::where('IDChallenge', $challenge->id)->where('category', 'Character')->get();
          $elementsRessource = Elements::where('IDChallenge', $challenge->id)->where('category', 'Ressource')->get();
          $elementsLocation = Elements::where('IDChallenge', $challenge->id)->where('category', 'Location')->get();
          $elementsQuest = Elements::where('IDChallenge', $challenge->id)->where('category', 'Quest')->get();
          $elementsDisruptive = Elements::where('IDChallenge', $challenge->id)->where('category', 'Disruptive element')->get();
          $elementsPayment = Elements::where('IDChallenge', $challenge->id)->where('category', 'Payment')->get();
          
          return view('admin.edit', [
            'challenge' => $challenge,
            'elements' => $elements,
            'elementsCharacter' => $elementsCharacter,
            'elementsRessource' => $elementsRessource,
            'elementsLocation' => $elementsLocation,
            'elementsQuest' => $elementsQuest,
            'elementsDisruptive' => $elementsDisruptive,
            'elementsPayment' => $elementsPayment,
          ]);
        }
        else{
          return redirect('/');
        }
      }
      else{
        return redirect('/');
      }
    }
    
    public function edit($challengeID, Request $request)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $isAdmin = $user->isAdmin;

        if ($isAdmin == 1){
          DB::table('challenges')
            ->where('id', $challengeID)
            ->update(
                array( 
                      "name" => $request->name,
                      "description" => $request->description,
                      "content" => $request->content,
                      "img_cover" => $request->img_cover,
                      )
          );
          return redirect()->back();
        }
        else{
          return redirect('/');
        }
      }
      else{
        return redirect('/');
      }
    }
    
    public function editStatus($challengeID, Request $request)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $isAdmin = $user->isAdmin;

        if ($isAdmin == 1){
          DB::table('challenges')
            ->where('id', $challengeID)
            ->update(
                array( 
                      "status" => $request->status,
                      )
          );
          return redirect()->back();
        }
        else{
          return redirect('/');
        }
      }
      else{
        return redirect('/');
      }
    }
    
    public function storeElements($challengeID, Request $request)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        $isAdmin = $user->isAdmin;

        if ($isAdmin == 1){
          
          /*store element*/
          $this->validate($request, [
              'label' => 'required|max:30',
              'category' => 'required',
              'difficulty' => 'required'
          ]);
          
          $element = new Elements;
          $element->IDChallenge = $challengeID;
          $element->label = $request->label;
          $element->category = $request->category;
          $element->difficulty = $request->difficulty;
          $element->save();
          
          return redirect()->back();
        }
        else{
          return redirect('/');
        }
      }
      else{
        return redirect('/');
      }
    }

    
}
