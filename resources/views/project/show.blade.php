@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="container">
      <h1><a href="https://github.com/{{$project->repo_owner}}/{{$project->repo_name}}">{{$project->name}}</a></h1>
      <h3>by <a href="https://github.com/{{$project->user->github_username}}">{{$project->user->name}}</a></h3>
      <p>
        {{$project->description}}
      </p>
    </div>
  </div>
@endsection
