<!DOCTYPE html>
<html lang="en">
<head>
  @include('agency.layouts.head')
</head>
<body>
  <div class="container-scroller">
    @include('agency.layouts.header')
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        @yield('content')

        @include('agency.layouts.footer')
      </div>
    </div>
  </div>
  @include('agency.layouts.scripts')
</body>
</html>
