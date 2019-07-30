<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/home" class="simple-text logo-normal">
      {{ __('COPE') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('problem.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Problem List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Resources') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'ranks' ? ' active' : '' }}">
        <a class="nav-link" href="">
          <i class="material-icons">format_list_numbered</i>
            <p>{{ __('Ranks') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'status' ? ' active' : '' }}">
        <a class="nav-link" href="">
          <i class="material-icons">live_tv</i>
            <p>{{ __('Status') }}</p>
        </a>
      </li>

      @if (Auth::user()->isAdmin())

      <hr />
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Admin') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'class-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> CM </span>
                <span class="sidebar-normal"> {{ __('Class Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'class-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> PM </span>
                <span class="sidebar-normal"> {{ __('Problem Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      @endif
    </ul>
  </div>
</div>