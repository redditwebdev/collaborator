@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="project-header">
            <h1><a href="https://github.com/{{$project->repo_owner}}/{{$project->repo_name}}" target="_blank">{{$project->name}}</a></h1>
            <p>by <a href="https://github.com/{{$project->user->github_username}}" target="_blank">{{$project->user->name}}</a></p>
            @if ($project->tags->count())
            <p>
              @foreach ($project->tags as $tag)
                <span class="tag"><a href="/tagged?q={{urlencode($tag->name)}}">{{$tag->name}}</a></span>
              @endforeach
            </p>
            @endif
          </div>
          @if ($project->description)
          <div class="project-description">
            <p>
              <strong>Project Description:</strong>
            </p>
            {{$project->description}}
          </div>
          @endif
        </div>
        <div class="col-xs-12 col-sm-5 col-sm-offset-1">
          <h2 class="text-center">Comments</h2>

          <div class="panel panel-default">
            <div class="panel-heading">
              <p class="panel-title"><strong>Username</strong> - <span title="2016-03-10 17:14:31">2 days ago</span></p>
            </div>
            <div class="panel-body">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
