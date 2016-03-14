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
     * @var Tag
     */
    private $tag;

    /**
     * PagesController constructor.
     * @param Project $project
     */
    public function __construct(Project $project, Tag $tag) {
      $this->project = $project;
        $this->tag = $tag;
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
