<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
      </ul>
      
    </form>
    <ul class="navbar-nav navbar-right">
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <img alt="{{ Auth::user()->name }}" src="{{ Auth::user()->profile_photo_url }}" class="rounded-circle mr-1">
      @endif
        <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <form action="{{ route('profile.show') }}" method="get">
            <button type="submit" class="dropdown-item has-icon">Profile</button>
          </form>  
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button type="submit" class="dropdown-item has-icon text-danger">Logout</button>
        </form>  
        </div>
      </li>
    </ul>
  </nav>