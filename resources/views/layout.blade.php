<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <title>Collaborator</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/dist/bundle.min.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Collaborator</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      @if(Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/new/project">New Project</a></li>
          <li><a href="/logout">Logout</a></li>
        </ul>
      @else
        <form class="navbar-right navbar-form">
          <a href="/auth/github" class="btn btn-default">Login <i class="fa fa-github fa-2x" style="vertical-align:middle;"></i></a>
        </form>
      @endif
    </div><!-- /.navbar-collapse -->
  </nav>

  @yield('content')

  <script src="/dist/bundle.min.js" charset="utf-8"></script>
</body>
</html>
