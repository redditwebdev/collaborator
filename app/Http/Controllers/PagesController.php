<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;

class PagesController extends Controller
{
    public function getIndex() {
      $recents = Project::latest()->take(9)->get();
      return view('index', compact('recents'));
    }
}
