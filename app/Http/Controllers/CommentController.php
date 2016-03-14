<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Comment;

use Illuminate\Contracts\Auth\Guard;

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
     * @var Guard
     */
    private $auth;

    /**
     * @var Comment
     */
    private $comment;

    /**
     * CommentController constructor.
     * @param Project $project
     */
    public function __construct(Project $project, Comment $comment, Guard $auth)
    {
        $this->project = $project;
        $this->comment = $comment;
        $this->auth = $auth;
    }

    /**
     * Returns comments of specific repo
     *
     * @param $owner
     * @param $repo
     * @return \Illuminate\Http\JsonResponse
     */
    public function comments($owner, $repo) {
        $comments = $this->project->where('repo_owner', $owner)->where('repo_name', $repo)->firstOrFail()->comments()->with('user')->get()->reverse();

        return response()->json($comments);
    }

    public function newComment(Request $request, $owner, $repo) {
        $project = $this->project->where('repo_owner', $owner)->where('repo_name', $repo)->firstOrFail();

        $errors = [];

        if (empty($request->body)) {
            $errors[] = 'This cannot be empty';
        }

        if (!empty($errors)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Form errors',
                'errors' => $errors
            ]);
        }

        $this->comment->create([
            'body' => $request->body,
            'user_id' => $this->auth->user()->id,
            'project_id' => $project->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment created'
        ]);
    }
}
