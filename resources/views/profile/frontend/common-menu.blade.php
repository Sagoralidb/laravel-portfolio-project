<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="{{route('home.front')}}" class="logo d-flex align-items-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename">Portfolio</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{route('home.front')}}" class="active">Home<br></a></li>
        <li><a href="{{ route('home.front') }}#about">About</a></li>
        <li><a href="{{ route('home.front') }}#services">Services</a></li>
        <li><a href="{{ route('home.front') }}#portfolio">Portfolio</a></li>   
        <li class="dropdown"><a href="#"><span>Features</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
          <ul>
            <li><a href="{{route('allService.front')}}">Services</a></li>
            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="#">Deep Dropdown 1</a></li>
                <li><a href="#">Deep Dropdown 2</a></li>
                <li><a href="#">Deep Dropdown 3</a></li>
                <li><a href="#">Deep Dropdown 4</a></li>
                <li><a href="#">Deep Dropdown 5</a></li>
              </ul>
            </li>
            <li><a href="#">Dropdown 2</a></li>
            <li><a href="#">Dropdown 3</a></li>
            <li><a href="#">Dropdown 4</a></li>
          </ul>
        </li>
        <li><a href="{{ route('home.front') }}#contact">Contact</a></li>
        <div>
          <ul>  
            @if (Auth::guard('web')->check())
              <li class="dropdown"><a href="#"><span>Account</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="{{route('dashboard.user')}}">{{ Auth::guard('web')->user()->name }}</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout.user') }}" method="POST" style="display: none;">
                      @csrf
                      </form>
                      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                </li>
              </ul>
            </li>
            @else
            <li><a href="{{ route('login.user') }}">Login</a></li>
            @endif         
          </ul>
         
      </div>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>