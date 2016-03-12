<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Tag;

class PagesController extends Controller
{
    public function getIndex() {
      $recents = Project::latest()->take(9)->get();
      return view('index', compact('recents'));
    }

    public function getSearch(Request $request) {
      $search = $request->q;

      if (Tag::whereName($search)->exists()) {
        $projects = Tag::whereName($search)->first()->projects->reverse();
      } else {
        $projects = Project::where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%')
                            ->orderBy('created_at', 'DESC')
                            ->get();
      }

      return view('project.search', compact('projects', 'search'));

    }
}
