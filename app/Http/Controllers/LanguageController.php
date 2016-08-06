<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Auth;
use Log;
use Session;

class LanguageController extends Controller
{

    public function setLang($lang)
    {
      Session::set('appLocale', $lang);
      return Redirect::back();
    }

}
