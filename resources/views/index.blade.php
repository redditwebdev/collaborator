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

      @foreach (array_chunk($recents->all(), 3) as $row)
      <div class="row">
        @foreach($row as $project)
          <div class="col-xs-12 col-sm-4">
            <h3><a href="/project/{{$project->repo_owner}}/{{$project->repo_name}}">{{$project->name}}</a></h3>
            <p>
              {{substr($project->description, 0, 60)}}...
            </p>
            <p>
              <a href="https://github.com/{{$project->user->github_username}}">{{$project->user->github_username}}</a>
              - {{$project->created_at->diffForHumans()}}
            </p>
          </div>
        @endforeach
      </div>
      @endforeach

    </div>
  </div>
@endsection
