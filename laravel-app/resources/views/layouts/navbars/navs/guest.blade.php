<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <a class="navbar-brand" href="{{ route('main') }}">COPE</a>
    </div>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <!--
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li> -->
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->