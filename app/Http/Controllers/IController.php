<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\login;
class IController extends Controller
{
   public function login()
   {
        return view('login');
   }
   
   public function uploadcsv()
   {
      return view('uploadcsv');
   }

   public function uploadimg()
   {
      return view('uploadimage');
   }

   public function change()
   {
      return view('change');
   }
}
