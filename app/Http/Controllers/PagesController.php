<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Tag;

class PagesController extends Controller
{
    /**
     * @var Project
     */
    private $project;

    /**
     * PagesController constructor.
     * @param Project $project
     */
    public function __construct(Project $project) {
      $this->project = $project;
    }

    /**
     * Index view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex() {
      $recents = $this->project->latest()->take(9)->get();
      return view('index', compact('recents'));
    }
}
