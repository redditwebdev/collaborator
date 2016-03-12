@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="container">
      <h1>Tagged {{$tag->name}}</h1>
      @foreach (array_chunk($tag->projects->reverse()->all(), 3) as $row)
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
