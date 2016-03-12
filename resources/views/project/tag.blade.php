@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="container">
      <h1>Tagged {{$tag->name}}</h1>
      @foreach (array_chunk($tag->projects->reverse()->all(), 3) as $row)
      <div class="row">
        @foreach($row as $project)
          <div class="col-xs-12 col-sm-4">
            <div class="project-card">
              <h3 class="project-card-title">
                <a href="/project/{{$project->repo_owner}}/{{$project->repo_name}}">{{$project->name}}</a>
              </h3>
              <p class="project-card-description">
                {{substr($project->description, 0, 60)}}...
              </p>
              <p class="project-card-meta">
                <a href="https://github.com/{{$project->user->github_username}}">{{$project->user->github_username}}</a>
                - {{$project->created_at->diffForHumans()}}
              </p>
              @if ($project->tags->count())
              <p class="tags">
                @foreach ($project->tags as $tag)
                  <span class="tag"><a href="/tagged?q={{urlencode($tag->name)}}">{{$tag->name}}</a></span>
                @endforeach
              </p>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      @endforeach
    </div>
  </div>
@endsection
