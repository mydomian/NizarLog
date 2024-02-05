<!DOCTYPE html>
<html lang="en">
<head>
  @include('driver.layouts.head')
</head>
<body>
  <div class="container-scroller">
    @include('driver.layouts.header')
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        @yield('content')

        @include('driver.layouts.footer')
      </div>
    </div>
  </div>
  @include('driver.layouts.scripts')
</body>
</html>
