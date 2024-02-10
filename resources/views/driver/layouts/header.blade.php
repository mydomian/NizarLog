<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
      <div class="container-fluid">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href=""><img  style="width:100px;height:80px;" src="{{ asset('/storage') }}/{{settings()->logo}}" alt="logo"/></a>
              <a class="navbar-brand brand-logo-mini" href=""><img style="width:64px;height:64px;" src="{{ asset('/storage') }}/{{settings()->logo}}" alt="logo"/></a>
          </div>
          <ul class="navbar-nav navbar-nav-right">
              {{-- <li class="nav-item dropdown  d-lg-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Air Bill</button>
              </li>
              <li class="nav-item dropdown  d-lg-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Client Manage</button>
              </li> --}}
              <li class="nav-item dropdown  d-lg-flex d-none">
                <button type="button" class="btn btn-inverse-primary btn-sm">Tracking</button>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                  <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                  <span class="online-status"></span>
                  <img src="@if(isset(Auth::user()->profile_photo_path)) {{ asset('/storage/profile/'.Auth::user()->profile_photo_path) }} @else {{ asset('/storage/profile/avatar.png') }} @endif" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ route('admin.settings') }}" class="dropdown-item">
                      <i class="mdi mdi-settings text-primary"></i>
                      Settings
                    </a>

                    <a href="{{ route('driver.logout') }}" class="dropdown-item">
                      <i class="mdi mdi-logout text-primary"></i>
                      Logout
                    </a>
                </div>
              </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </div>
    </nav>
    <nav class="bottom-navbar">
      <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a class="nav-link text-warning" href="">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-warning">
                  <i class="mdi mdi-book-open-variant menu-icon"></i>
                  <span class="menu-title">Booking</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/ui-elements') }}">Air Bill</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/ui-elements') }}">Lists</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/ui-elements') }}">Status</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/ui-elements') }}">Tracking</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link text-warning">
                <i class="mdi mdi-account-key menu-icon"></i>
                <span class="menu-title">Client</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                  <ul>
                      <li class="nav-item"><a class="nav-link" href="">Add</a></li>
                      <li class="nav-item"><a class="nav-link" href="">Lists</a></li>
                  </ul>
              </div>
          </li>
            <li class="nav-item">
              <a href="" class="nav-link text-warning">
                <i class="mdi mdi-car-connected menu-icon"></i>
                <span class="menu-title">Driver</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                  <ul>
                      <li class="nav-item"><a class="nav-link" href="">Add</a></li>
                      <li class="nav-item"><a class="nav-link" href="">Lists</a></li>
                  </ul>
              </div>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link text-warning">
              <i class="mdi mdi-access-point-network menu-icon"></i>
              <span class="menu-title">Service Area</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="submenu">
                <ul>
                    <li class="nav-item"><a class="nav-link" href="">Add</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Lists</a></li>
                </ul>
            </div>
          </li>

            <li class="nav-item">
              <a href="#" class="nav-link text-warning">
                <i class="mdi mdi-account-settings menu-icon"></i>
                <span class="menu-title">Charge</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                  <ul>
                      <li class="nav-item"><a class="nav-link" href="">Delivery Charge</a></li>
                      <li class="nav-item"><a class="nav-link" href="">Payment</a></li>
                  </ul>
              </div>
          </li>

            <li class="nav-item">
              <a href="{{ url('/sample-pages') }}" class="nav-link text-warning">
                <i class="mdi mdi-playlist-check menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
              </a>
          </li>
            <li class="nav-item">
                <a href="{{ route('admin.settings') }}" class="nav-link text-warning">
                  <i class="mdi mdi-settings menu-icon"></i>
                  <span class="menu-title">Settings</span></a>
            </li>
          </ul>
      </div>
    </nav>
  </div>
