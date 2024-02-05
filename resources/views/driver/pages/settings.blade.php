@extends('admin.layouts.master')
@section('title')
Settings
@endsection
@section('content')

    <div class="content-wrapper">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center mt-3 text-warning">Website Settings</h3>
                    <div class="card-body">
                        <form action="{{route('admin.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name" class="form-label">Application Name <strong class="text-danger">*</strong></label>
                                    <input type="text" name="name" value="{{ settings()->name }}" class="form-control border-warning @error('name') is-invalid @enderror" placeholder="Name">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    |@enderror
                                </div>
                                <div class="col">
                                    <label for="phone" class="form-label">Phone <strong class="text-danger">*</strong></label>
                                    <input type="number" name="phone" value="{{settings()->phone}}" class="form-control border-warning @error('phone') is-invalid @enderror" placeholder="Phone">
                                    @error('phone')
                                    <small class="text-danger">{{$message}}</small>
                                    |@enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="email" class="form-label">Email <strong class="text-danger">*</strong></label>
                                    <input type="email" name="email" value="{{settings()->email}}" class="form-control border-warning @error('email') is-invalid @enderror" placeholder="Email">
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                    |@enderror
                                </div>
                                <div class="col">
                                    <label for="address" class="form-label">Address <strong class="text-danger">*</strong></label>
                                    <input type="text" name="address" value="{{settings()->address}}" class="form-control border-warning @error('address') is-invalid @enderror" placeholder="Address">
                                    @error('address')
                                    <small class="text-danger">{{$message}}</small>
                                    |@enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                              <div class="col">
                                <label for="logo" class="form-label">Website Logo <strong class="text-danger">*</strong></label>
                                <input type="file" name="logo" class="form-control border-warning @error('logo') is-invalid @enderror" accept="image/*">
                                @error('logo')
                                <small class="text-danger">{{$message}}</small>
                            |@enderror
                            </div>
                                <div class="col">
                                  <label for="favicon" class="form-label">Favicon <strong class="text-danger">*</strong></label>
                                    <input type="file" name="favicon" class="form-control border-warning @error('favicon') is-invalid @enderror" accept="image/*">
                                    @error('favicon')
                                    <small class="text-danger">{{$message}}</small>
                                |@enderror
                                  </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                 <small> Existing Logo: </small> <br>
                                    <img src="{{asset('storage')}}/{{settings()->logo}}" alt=""  class="img-fluid mt-1">
                                </div>
                                <div class="col">
                                  <small>Existing Favicon: </small><br>
                                    <img src="{{asset('storage')}}/{{settings()->favicon}}" alt="" class="img-fluid mt-1">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-warning">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
