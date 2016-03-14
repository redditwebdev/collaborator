<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Tag;

class SearchController extends Controller
{
    /**
     * @var Project
     */
    private $project;

    /**
     * @var Tag
     */
    private $tag;

    /**
     * SearchController constructor.
     * @param Project $project
     * @param Tag $tag
     */
    public function __construct(Project $project, Tag $tag) {
      $this->project = $project;
      $this->tag = $tag;
    }

    /**
     * Get search results and display view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSearch(Request $request) {
      // Store the search so we can send it with the view
      $search = $request->q;

      // Check if the search directly matches a tag
      if ($this->tag->whereName($search)->exists()) {
        // If a tag is found we'll just show all projects with that tag
        $projects = $this->tag->whereName($search)->first()->projects->reverse();
      } else {
        // Otherwise find the matching projects by name or description
        $projects = $this->project->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%')
                            ->orderBy('created_at', 'DESC')
                            ->get();
      }

      return view('project.search', compact('projects', 'search'));
    }
}
