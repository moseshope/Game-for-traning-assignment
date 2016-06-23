<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Challenges;
use App\Ideas;
use App\Votes;
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
          $users = DB::table('users')->orderBy('isAdmin', 'desc')->orderBy('name', 'asc')->get();

          return view('admin.home', [
            'challenges' => $challenges,
            'challengesNB' => $challengesNB,
            'usersNB' => $usersNB,
            'ideasNB' => $ideasNB,
            'users' => $users,
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

    public function editColor($challengeID, Request $request)
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
                      "color" => $request->color,
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

    public function editContext($challengeID, Request $request)
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
                      "context" => $request->context,
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

    public function deleteElement($elementID, Request $request){
      DB::table('elements')->where('id', $elementID)->delete();
      return redirect()->back();
      // return redirect()->back()->with('status', 'Profile updated!');
    }
    
    public function deleteIdea($ideaID){
      DB::table('ideas')->where('IDIdea', $ideaID)->delete();
      // DB::table('ideas_elements')->where('IDIdea', $ideaID)->delete();
      // DB::table('votes')->where('IDIdea', $ideaID)->delete();
      return redirect()->back();
      // return redirect()->back()->with('status', 'Profile updated!');
    }
    
    public function rightsAdmin($userID, Request $request)
    {
      $user = Auth::user();
      if (isset($user)) {
        Log::info($user);
        
        $isAdmin =  DB::table('users')->select('isAdmin')->where('id', $userID)->get();
        
        if ($isAdmin[0]->isAdmin == 1){
          DB::table('users')->where('id', $userID)->update(array("isAdmin" => '0',));
          return redirect()->back();
        }
        else{
          DB::table('users')->where('id', $userID)->update(array("isAdmin" => '1',));
          return redirect()->back();
        }
      }
      else{
        return redirect('/');
      }
    }
    // {
    //   $user = Auth::user();
    // 
    //   $isAdmin =  DB::table('users')->select('isAdmin')->where('id', $userID)->get();
    //   
    //   return $isAdmin;
    //   
    //   if ($isAdmin[0] == '0'){
    //     return "is not admin";
    //     DB::table('users')->where('id', $userID)->update(
    //         array(
    //               "isAdmin" => '1',
    //               )
    //         );
    //   }
    //   else {
    //     return "is admin";
    //     DB::table('users')->where('id', $userID)->update(
    //         array(
    //               "isAdmin" => '0',
    //               )
    //         );
    //   }
    // }

    public function export($challengeID){
      $challenge = Challenges::where('id', $challengeID)->first();
      $ideas = Ideas::orderBy('created_at', 'desc')->where('IDChallenge', $challengeID)->get();
      foreach ($ideas as $key) {
        $ideas->element = IdeasElements::where('id', $key->IDElements)->get();
        $key->votes = Votes::where('IDIdea', $key->IDIdea )->count();
      }

      $filename = 'ideas-'.$challenge->name.'.csv';
      $handle = fopen($filename, 'w+');
      fputcsv($handle, array('Title', 'Description', 'Rebounds', 'Character', 'Place', 'Ressource', 'Quest', 'Warning', 'Treasure', 'Votes' ));

      foreach($ideas as $row) {
        fputcsv($handle, array(
          $row['title'],
          $row['content'],
          $row['rebounds'],
          $row->element['character'],
          $row->element['place'],
          $row->element['ressource'],
          $row->element['quest'],
          $row->element['warning'],
          $row->element['treasure'],
          $row['votes']
        ));}

      fclose($handle);

      $headers = array(
          'Content-Type' => 'text/csv',
      );

       return response()->download($filename, 'ideas-'.$challenge->name.'.csv', $headers);
    }


}
