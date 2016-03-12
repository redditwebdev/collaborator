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
