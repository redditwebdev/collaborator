@extends('layout')

@section('content')
  <div class="hero hero-1-3">
    <div class="hero-content text-center">
      <h1>Find collaborators for open source projects</h1>
      <input type="text" placeholder="Search for a project, language, etc..." class="form-control">
    </div>
  </div>
  <div class="wrapper">

    <div class="container">
      <h1>Most recent projects</h1>

      <div class="row">
        @foreach($recents as $project)
          <div class="col-xs-12 col-sm-4">
            <div class="panel panel-default ">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="/project/{{$project->repo_owner}}/{{$project->repo_name}}">{{$project->name}}</a></h3>
              </div>
              <div class="panel-body">
                {{$project->description}}
              </div>
              <div class="panel-footer">
                <a href="https://github.com/{{$project->user->github_username}}">{{$project->user->github_username}}</a>

                <span class="pull-right">
                  {{$project->created_at->diffForHumans()}}
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </div>
@endsection
