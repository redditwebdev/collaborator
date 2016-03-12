@extends('layout')

@section('content')
  <div class="wrapper">
    <div class="container">
      <h1>Search Results ({{$projects->count()}})</h1>
      <form action="/search" method="GET">
        <div class="input-group">
          <input type="text" name="q" value="{{$search}}" placeholder="Search for a project, language, etc..." class="form-control">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Search</button>
          </span>
        </div>
      </form>
      @foreach (array_chunk($projects->all(), 3) as $row)
      <div class="row" style="margin-top:25px;">
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
