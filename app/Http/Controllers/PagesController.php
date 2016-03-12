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
      // Store the search so we can send it with the view
      $search = $request->q;

      // Check if the search directly matches a tag
      if (Tag::whereName($search)->exists()) {
        // If a tag is found we'll just show all projects with that tag
        $projects = Tag::whereName($search)->first()->projects->reverse();
      } else {
        // Otherwise find the matching projects by name or description
        $projects = Project::where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%')
                            ->orderBy('created_at', 'DESC')
                            ->get();
      }

      return view('project.search', compact('projects', 'search'));

    }
}
