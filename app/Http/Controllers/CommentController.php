<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @var Project
     */
    private $project;

    /**
     * CommentController constructor.
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Returns comments of specific repo
     *
     * @param $owner
     * @param $repo
     * @return \Illuminate\Http\JsonResponse
     */
    public function comments($owner, $repo) {
        $comments = $this->project->where('repo_owner', $owner)->where('repo_name', $repo)->firstOrFail()->comments()->with('user')->get();

        return response()->json($comments);
    }
}
