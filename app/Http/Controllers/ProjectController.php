<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Project;
use App\Tag;
use GrahamCampbell\GitHub\Facades\GitHub;

class ProjectController extends Controller
{
    public function getNew() {
      return view('project.new');
    }

    public function getProject($owner, $name) {
      $project = Project::where('repo_name', $name)->where('repo_owner', $owner)->firstOrFail();

      return view('project.show', compact('project'));
    }

    public function create(Request $request) {

      $errors = [];

      if (empty($request->name)) {
        $errors[] = 'Name is required';
      }

      if (empty($request->repo_name)) {
        $errors[] = 'You must select a repo';
      }

      if (Project::where('repo_name', $request->repo_name)->where('repo_owner', $request->repo_owner)->exists()) {
        $errors[] = 'You have already added this repo';
      }

      if (!empty($errors)) {
        return response()->json([
          'status' => 'error',
          'message' => 'Form Errors',
          'errors' => $errors
        ]);
      }

      $project = Project::create([
        'name' => $request->name,
        'description' => $request->description,
        'repo_name' => $request->repo_name,
        'repo_owner' => $request->repo_owner,
        'user_id' => Auth::user()->id
      ]);

      $tags = $request->tags;

      $tag_ids = [];

      // Loop through the tags passed
      // If the tag hasn't been created yet, make it
      // Then push the id of the tag into the tag_ids array for syncing
      foreach ($tags as $tag) {
        if ($temp = Tag::whereName($tag)->exists()) {
          $tag_ids[] = $temp->id;
        } else {
          $temp = Tag::create([
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

    public function show($owner, $name) {
      $project = Project::where('repo_name', $name)->where('repo_owner', $owner)->firstOrFail();

      return response()->json($project);
    }

    public function getTagged(Request $request) {
      $tag = Tag::whereName(urldecode($request->q))->firstOrFail();

      return view('project.tag', compact('tag'));
    }
}
