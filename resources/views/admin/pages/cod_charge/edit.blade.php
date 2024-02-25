@extends('admin.layouts.master')
@section('title')
COD Charge Edit
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
        <h5 class="text-center mt-3 text-warning">Edit COD Charge</h5>
          <div class="card-body">

            <form action="{{ route('admin-cod-charge.update',$cod->id) }}" method="post">
            @csrf
            @method('put')

                <div class="row">
                    <div class="col" data-toggle="tooltip" data-placement="top" title="Type Select">
                        <select id="type" class="js-example-basic-single @error('type') is-invalid @enderror" name="type" style="width:100%">
                            <option value="">Type Select</option>

                            <option value="desk_booking" @if($cod->type == 'desk_booking') selected @endif>Desk Booking</option>
                            <option value="agency" @if($cod->type == 'agency') selected @endif>Agency</option>

                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="charge_percent" class="form-control border-warning @error('charge_percent') is-invalid @enderror" value="{{ $cod->charge_percent }}" placeholder="Charge Percent" data-toggle="tooltip" data-placement="top" title="Charge Percent">
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
