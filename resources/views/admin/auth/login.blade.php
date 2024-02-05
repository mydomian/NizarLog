
@extends('admin.auth.layouts.master')
@section('title')
Admin Login
@endsection
@section('authentication')
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="main-panel">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-3 px-4 px-sm-5">
              <div class="brand-logo text-center mb-0">
                <img src="{{ asset('/storage/logo.png') }}" alt="logo" style="width: 100px;height:90px;">
              </div>
              <h6 class="font-weight-light text-center">Sign in to continue.</h6>
              <small class="text-danger">@error('email') {{ $message }} @enderror</small>
              <form  method="POST" action="{{ route('admin.login') }}" class="pt-3">
              @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email" required autofocus>

                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password"  required autocomplete="current-password">
                </div>
                <div class="mt-3 d-flex justify-content-between">
                  <a href="#" class="auth-link text-black" style="font-size: 12px;">Forgot password?</a>
                  <button type="submit" class="btn btn-sm btn-primary">Login</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

