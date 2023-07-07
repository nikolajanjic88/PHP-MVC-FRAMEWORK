<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <?php if(!isset($_SESSION['user'])): ?>
      <li class="nav-item">
        <a class="nav-link" href="/register">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/login">Login</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
      <?php endif ?>
    </ul>
  </div>
</nav>