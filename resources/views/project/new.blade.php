@extends('layout')

@section('content')
  <div class="wrapper" ng-app="project" ng-controller="NewProjectController as vm">
    <div class="container">
      <h1>Start a new project</h1>

      <form ng-submit="vm.submit()">
        <div class="alert alert-danger" ng-show="vm.errors.length != 0">
          <p ng-repeat="error in vm.errors">
            @{{error}}
          </p>
        </div>
        <div class="row">
          <div class="form-group col-xs-12 col-sm-6">
            <label for="repository">Select which repo</label>
            <select class="form-control" ng-model="vm.repoId" ng-init="vm.getRepos()" ng-disabled="vm.repos.length == 0" ng-change="vm.selectRepo()">
              <option value="@{{repo.id}}" ng-repeat="repo in vm.repos">@{{repo.name}}</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-12 col-sm-6">
            <label for="repository">Give your project a name</label>
            <input type="text" class="form-control" ng-model="vm.model.name">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-12">
            <label for="description">Briefly describe the project</label>
            <textarea class="form-control" ng-model="vm.model.description"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
