<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.head')
</head>
<body>
  <div class="container-scroller">
    @include('admin.layouts.header')
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        @yield('content')
        
        @include('admin.layouts.footer')
      </div>
    </div>
  </div>
  @include('admin.layouts.scripts')
</body>
</html>