<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use App\Project;
use App\Tag;

class ProjectController extends Controller
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
     * @var Guard
     */
    private $auth;

      /**
     * ProjectController constructor.
     * @param Project $project
     * @param Tag $tag
     * @param Auth $auth
     */
    public function __construct(Project $project, Tag $tag, Guard $auth) {
      $this->project = $project;
      $this->tag = $tag;
      $this->auth = $auth;
    }

    /**
     * View for creating a new project
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNew() {
      return view('project.new');
    }

    /**
     * View for showing a project
     *
     * url format of /project/{owner}/{repo}
     *
     * @param $owner
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProject($owner, $repo) {
      $project = $this->project->where('repo_name', $repo)->where('repo_owner', $owner)->firstOrFail();

      return view('project.show', compact('project'));
    }

    /**
     * POST call to create a new project
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {

      $errors = [];

      if (empty($request->name)) {
        $errors[] = 'Name is required';
      }

      if (empty($request->repo_name)) {
        $errors[] = 'You must select a repo';
      }

      if ($this->project->where('repo_name', $request->repo_name)->where('repo_owner', $request->repo_owner)->exists()) {
        $errors[] = 'You have already added this repo';
      }

      if (!empty($errors)) {
        return response()->json([
          'status' => 'error',
          'message' => 'Form Errors',
          'errors' => $errors
        ]);
      }

      $project = $this->project->create([
        'name' => $request->name,
        'description' => $request->description,
        'repo_name' => $request->repo_name,
        'repo_owner' => $request->repo_owner,
        'user_id' => $this->auth->user()->id
      ]);

      $tags = $request->tags;

      $tag_ids = [];

      // Loop through the tags passed
      // If the tag hasn't been created yet, make it
      // Then push the id of the tag into the tag_ids array for syncing
      foreach ($tags as $tag) {
        if ($temp = $this->tag->whereName($tag)->first()) {
          $tag_ids[] = $temp->id;
        } else {
          $temp = $this->tag->create([
            'name' => $tag
          ]);
          $tag_ids[] = $temp->id;
        }
      }

      $project->tags()->sync($tag_ids);

      return response()->json([
        'status' => 'success',
        'message' => 'Created project'
      ]);
    }
}
