<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/posts">
      Vivify Blog
    </a>
    @auth
    <a href="/posts/create" class="navbar-brand">
      Create Post
    </a>
    <div>
      {{ auth()->user()->name }}
    </div>
    <div>
      <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Logut</button>
      </form>
    </div>
    @else
      <div>
        <a href="/login" class="nav-link">Login</a>
      </div>
      <div>
        <a href="/register" class="nav-link">Register</a>
      </div>
    @endauth

  </div>
</nav>