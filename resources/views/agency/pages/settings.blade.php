@extends('agency.layouts.master')
@section('title')
Settings
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="d-flex justify-content-between px-4  mt-3">
                <h5 class="text-center text-warning">Profile Settings</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#passwordModal">Change Password</button>
            </div>
          <div class="card-body">
            <form action="{{route('agency.settings')}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row text-center">
                    <div class="col">
                        <img src="{{$user_info->user->profile_photo_path ? asset('storage/profile').'/'.$user_info->user->profile_photo_path : $user_info->user->profile_photo_url}}" alt="" height="150" width="150" class="rounded-circle">
                    </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                    <input type="text" name="name" class="form-control border-warning @error('name') is-invalid @enderror" placeholder="Name" value="{{ $user_info->user->name }}" data-toggle="tooltip" data-placement="top" title="Name">
                    @error('name')
                      <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <div class="col">
                    <input type="number" name="phone" class="form-control border-warning @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ $user_info->phone }}" data-toggle="tooltip" data-placement="top" title="Phone">
                    @error('phone')
                      <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <input type="text" name="address" class="form-control border-warning @error('address') is-invalid @enderror" placeholder="Address" value="{{ $user_info->address }}" data-toggle="tooltip" data-placement="top" title="Address">
                    @error('address')
                      <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  {{-- <div class="col">
                    <input type="text" name="pin" class="form-control border-warning @error('pin') is-invalid @enderror" placeholder="Pin" value="" data-toggle="tooltip" data-placement="top" title="Pin">
                  </div> --}}
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <input type="file" name="profile" class="form-control border-warning @error('profile') is-invalid @enderror" accept="image/*" data-toggle="tooltip" data-placement="top" title="Profile Picture">
                  @error('profile')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <input type="file" name="cv" class="form-control border-warning @error('cv') is-invalid @enderror" placeholder="cv" data-toggle="tooltip" data-placement="top" title="Upload CV" accept=".doc, .docx,.ppt, .pptx,.txt,.pdf">
                    @error('cv')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                    <a href="{{asset('storage/cv')}}/{{$user_info->cv}}" class="text-primary text-decoration-none d-flex justify-content-end" target="_blank"><small>VIEW CV</small></a>
                  </div>
                </div>
                <div class="row mt-5">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-warning">Update Profile</button>
                    </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>
@push('agency-modals')
  <!-- confirmModal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('agency.password.confirm')}}" method="post">
        @csrf
        <div class="modal-body">
            <input type="password" name="password" class="form-control border-primary @error('password') is-invalid border-danger @enderror" value="" placeholder="Enter current password to verify...">
            @error('password')
              <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Set New Password Modal-->
@if (session()->has('change-password'))
<div class="modal fade" id="setPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1"  aria-labelledby="exampleModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Set New Password</h1>
        <a href="{{route('agency.cancel.change.password')}}" class="btn-close"></a>
      </div>
      <form action="{{route('agency.password.update')}}" method="post">
        @csrf
        <div class="modal-body">
            <input type="password" name="new_password" class="form-control border-primary mb-3" value="" placeholder="Set new password...">
            @error('new_password')
              <small class="text-danger">{{$message}}</small>
            @enderror
            <input type="password" name="confirm_new_password" class="form-control border-primary" value="" placeholder="Confirm new password...">
            @error('confirm_new_password')
              <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="modal-footer">
          <a href="{{route('agency.cancel.change.password')}}" class="btn btn-secondary">Cancel</a>
          <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endpush
@endsection
@push('agency-scripts')
 <script>
    $(document).ready(function(){
      @if ($errors->has('password'))
        $('#passwordModal').modal('show')
      @endif
      @if ($errors->has('new_password') || $errors->has('confirm_new_password'))
        $('#setPasswordModal').modal('show')
      @endif
      @if (session()->has('change-password'))
        $('#setPasswordModal').modal('show')
      @endif
    })
 </script>
@endpush
