<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
      <div class="container-fluid">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href=""><img  style="width:100px;height:80px;" src="{{ asset('/storage') }}/{{settings()->logo}}" alt="logo"/></a>
              <a class="navbar-brand brand-logo-mini" href=""><img style="width:64px;height:64px;" src="{{ asset('/storage') }}/{{settings()->logo}}" alt="logo"/></a>
          </div>
          <ul class="navbar-nav navbar-nav-right">

            <div class="gtranslate_wrapper"></div>

              <li class="nav-item dropdown  d-lg-flex d-none">
                <a href="{{ route('admin-air-bills.create') }}" class="btn btn-inverse-primary btn-sm">Air Bill</a>
              </li>
              <li class="nav-item dropdown  d-lg-flex d-none">
                <a href="{{ route('adminTracking') }}" class="btn btn-inverse-primary btn-sm">Tracking</a>
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

                    <a href="{{ route('admin.logout') }}" class="dropdown-item">
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
              <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-air-bills.create') }}">Air Bill</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-air-bills.index') }}">Lists Pickup Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('adminListsAssignDeliveryman') }}">Lists Assign Driver</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('adminListsPickupReceived') }}">Lists Pickup Received</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('adminListsHubStore') }}">Lists Hub Store</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('adminListsTransit') }}">Lists Transit</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('adminListsDelivered') }}">Lists Delivered</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('adminListsReturn') }}">Lists Return</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('adminTracking') }}">Tracking</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link text-warning">
                <i class="mdi mdi-account-key menu-icon"></i>
                <span class="menu-title">Agency</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="submenu">
                  <ul>
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin-agencies.create') }}">Add</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin-agencies.index') }}">Lists</a></li>
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
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin-drivers.create') }}">Add</a></li>
                      <li class="nav-item"><a class="nav-link" href="{{ route('admin-drivers.index') }}">Lists</a></li>
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
                  <div class="submenu">
                    <ul>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-area-types.index') }}">Lists Area Type</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-parcel-types.index') }}">Lists Parcel Type</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-delivery-types.index') }}">Lists Delivery Type</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-delivery-charges.index') }}">Lists Delivery Charge</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-hubs.index') }}">Lists Hub</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin-cod-charge.index') }}">Lists COD Charge</a></li>

                    </ul>
                </div>
            </li>
          </ul>
      </div>
    </nav>
  </div>
