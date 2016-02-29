<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Project;
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

      return response()->json([
        'status' => 'success',
        'message' => 'Created project'
      ]);
    }

    public function show($owner, $name) {
      $project = Project::where('repo_name', $name)->where('repo_owner', $owner)->firstOrFail();

      return response()->json($project);
    }
}
