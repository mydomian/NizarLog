<meta charset="utf-8">
<!-- meta tag will be there -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('meta-tags')
<title>@yield('title') | {{settings()->name}}</title>
<!-- favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/storage') }}/{{settings()->favicon}}">
<link rel="icon" type="image/png" href="{{ asset('/storage') }}/{{settings()->favicon}}" sizes="180x180">
<link rel="icon" type="image/png" href="{{ asset('/storage') }}/{{settings()->favicon}}" sizes="180x180">
<link rel="shortcut icon" sizes="180x180" href="{{ asset('/storage') }}/{{settings()->favicon}}" />
<!-- css link -->
<link rel="stylesheet" href="{{ asset('/storage/vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/vendors/base/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('/storage/css/style.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stack('admin-links-css')
