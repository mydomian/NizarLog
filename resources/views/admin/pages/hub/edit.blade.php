@extends('admin.layouts.master')
@section('title')
Hub Edit
@endsection
@push('admin-links-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 44px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 39px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 41px;
    }
    .select2-container--default .select2-selection--single {
        border: 1px solid #FCD53B;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
 </style>
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Edit Hub</h5>
          <div class="card-body">

            <form action="{{ route('admin-hubs.update',$hubData->id) }}" method="post">
            @csrf
            @method('put')

                <div class="row">
                    <div class="col" data-toggle="tooltip" data-placement="top" title="Hub Parent Select">
                        <select id="hub_parent" class="js-example-basic-single @error('hub_parent') is-invalid @enderror" name="hub_parent" style="width:100%">
                            <option value="">Parent Hub Select</option>
                            @foreach ($hubs as $hub)
                                <option value="{{ $hub->hub_name }}" @if($hub->hub_name == $hubData->hub_name) selected @endif>{{ $hub->hub_name }} - ({{ $hub->hub_parent ? $hub->hub_parent : 'Parent' }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="hub_name" class="form-control border-warning @error('hub_name') is-invalid @enderror" value="{{ $hubData->hub_name }}" placeholder="Hub Name" data-toggle="tooltip" data-placement="top" title="Hub Name">
                    </div>
                    <div class="col">
                        <input type="text" name="hub_code" class="form-control border-warning @error('hub_code') is-invalid @enderror" value="{{ $hubData->hub_code }}" placeholder="Hub Code" data-toggle="tooltip" data-placement="top" title="Hub Code">
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
