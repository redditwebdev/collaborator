@extends('layout')

@section('content')
  <div class="wrapper" ng-app="project">
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
        <div class="col-xs-12 col-sm-5 col-sm-offset-1" ng-controller="CommentController as vm" ng-init="vm.project = {{ $project }}; vm.getComments()">
          <h2 class="text-center">Comments</h2>
          <div class="alert alert-danger" ng-show="vm.errors.length != 0">
            <p ng-repeat="error in vm.errors">
              @{{ error }}
            </p>
          </div>
          <form ng-submit="vm.submitComment()" class="clearfix">
            <div class="form-group">
              <textarea ng-model="vm.newComment" class="form-control"></textarea>
            </div>
            <div class="form-group clearfix">
              <button type="submit" class="btn btn-primary pull-right">Post</button>
            </div>
          </form>
          <pre marked="vm.newComment" ng-show="vm.newComment != ''"></pre>
          <div class="panel panel-default" ng-repeat="comment in vm.comments">
            <div class="panel-heading">
              <p class="panel-title"><strong>@{{ comment.user.github_username }}</strong> - <span title="@{{ comment.created_at }}">@{{ comment.created_at }}</span></p>
            </div>
            <div class="panel-body" marked="comment.body"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
