@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
<nav
class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
data-nav="brand-center">
<div class="navbar-header d-xl-block d-none">
  
</div>
@else
    <nav
      class="header-navbar navbar navbar-expand-lg align-items-center bg-primary {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating'? 'container-xxl': '' }}">
@endif
<div class="navbar-container d-flex content">
  <div class="bookmark-wrapper d-flex align-items-center">
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
            data-feather="menu"></i></a></li>
    </ul>
    
  </div>
  <ul class="nav navbar-nav align-items-center ms-auto">
    <li class="nav-item">
      
    </li>
    <li class="nav-item dropdown dropdown-user">
      <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
        data-bs-toggle="dropdown" aria-haspopup="true">
        <div class="user-nav d-sm-flex d-none">
          <p class="user-name fw-bolder text-white">
            Hai,
            @if (Auth::check())
              {{ Auth::user()->name }}
            @else
              John Doe
            @endif
          </p>
        </div>
        <span class="avatar">
          <img class="round"
            src="{{ Auth::user() ? Auth::user()->profile_photo_url : asset('images/portrait/small/avatar-s-11.jpg') }}"
            alt="avatar" height="40" width="40">
          <span class="avatar-status-online"></span>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        @if (Auth::check())
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="me-50" data-feather="power"></i> Keluar
          </a>
          <form method="POST" id="logout-form" action="{{ route('logout') }}">
            @csrf
          </form>
        @else
          <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
            <i class="me-50" data-feather="log-in"></i> Masuk
          </a>
        @endif
      </div>
    </li>
  </ul>
</div>
</nav>
<!-- END: Header-->
