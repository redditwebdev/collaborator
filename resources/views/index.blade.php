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
      <div class="most-recent">
        <h1>Newest Projects</h1>

        @foreach (array_chunk($recents->all(), 3) as $row)
        <div class="row">
          @foreach($row as $project)
            <div class="col-xs-12 col-sm-4">
              @include('partials.projectCard')
            </div>
          @endforeach
        </div>
        @endforeach
      </div>

    </div>
  </div>
@endsection
