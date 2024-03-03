@extends('admin.layouts.master')
@section('title')
Agency Edit
@endsection
@push('admin-links-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 42px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    .select2-container--default .select2-selection--single {
        border: 1px solid #FCD53B;
    }
 </style>
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Edit Agency</h5>
          <div class="card-body">

            <form action="{{ route('admin-agencies.update',$agency->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
                <div class="row">
                  <div class="col">
                    <input type="text" name="name" class="form-control border-warning @error('name') is-invalid @enderror" placeholder="Name" value="{{ $agency->name }}" data-toggle="tooltip" data-placement="top" title="Name">
                  </div>
                  <div class="col">
                    <input type="number" name="phone" class="form-control border-warning @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ $agency->user_info->phone }}" data-toggle="tooltip" data-placement="top" title="Phone">
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <input type="email" name="email" class="form-control border-warning @error('email') is-invalid @enderror" placeholder="Email" value="{{ $agency->email }}" data-toggle="tooltip" data-placement="top" title="Email">
                  </div>
                  <div class="col">
                    <input type="text" name="address" class="form-control border-warning @error('address') is-invalid @enderror" placeholder="Address" value="{{ $agency->user_info->address }}" data-toggle="tooltip" data-placement="top" title="Address">
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <input type="text" name="pin" class="form-control border-warning @error('pin') is-invalid @enderror" placeholder="Pin" value="{{ $agency->user_info->pin }}" data-toggle="tooltip" data-placement="top" title="Pin">
                  </div>
                  <div class="col">
                    <input type="file" name="profile" class="form-control border-warning @error('profile') is-invalid @enderror" accept="image/*" data-toggle="tooltip" data-placement="top" title="Profile Picture">
                  </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <select class="js-example-basic-single @error('service_area') is-invalid @enderror" name="service_area" style="width:100%" data-toggle="tooltip" data-placement="top" title="Service Area" required>
                            <option value="">Select Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->hub_name }}" @if($area->hub_name == $agency->user_info->service_area) selected @endif>{{ $area->hub_name }} ({{ $area->hub_code }})</option>
                            @endforeach
                        </select>
                      </div>
                  <div class="col">
                    <input type="file" name="licence" class="form-control border-warning @error('licence') is-invalid @enderror" placeholder="Licence" data-toggle="tooltip" data-placement="top" title="Upload Licence" accept=".doc, .docx,.ppt, .pptx,.txt,.pdf">
                  </div>
                </div>
                <div class="row mt-2">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-warning">Update</button>
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('admin-scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
