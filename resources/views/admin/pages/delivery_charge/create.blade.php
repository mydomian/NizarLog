@extends('admin.layouts.master')
@section('title')
Delivery Charge Add
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
 </style>
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Delivery Charge</h5>
          <div class="card-body">

            <form action="{{ route('admin-delivery-charges.store') }}" method="post">
            @csrf
                <div class="row">
                  <div class="col">
                    <select class="js-example-basic-single @error('area_type_id') is-invalid @enderror" name="area_type_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Area Type" required>
                        <option value="">Select Area Type</option>
                        @foreach ($areaTypes as $areaType)
                            <option value="{{ $areaType->id }}">{{ $areaType->type }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <select class="js-example-basic-single @error('parcel_type_id') is-invalid @enderror" name="parcel_type_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Parcel Type" required>
                        <option value="">Select Parcel Type</option>
                        @foreach ($parcelTypes as $parcelType)
                            <option value="{{ $parcelType->id }}">{{ $parcelType->type }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <select class="js-example-basic-single @error('delivery_type_id') is-invalid @enderror" name="delivery_type_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Delivery Type" required>
                        <option value="">Select Delivery Type</option>
                        @foreach ($deliveryTypes as $deliveryType)
                            <option value="{{ $deliveryType->id }}">{{ $deliveryType->type }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                    <input type="text" name="weight" class="form-control border-warning @error('weight') is-invalid @enderror" placeholder="Weight" data-toggle="tooltip" data-placement="top" title="Weight">
                  </div>
                  <div class="col">
                    <input type="number" name="delivery_charge" class="form-control border-warning @error('delivery_charge') is-invalid @enderror" placeholder="Delivery Charge" data-toggle="tooltip" data-placement="top" title="Delivery Charge">
                  </div>
                </div>
                <div class="row mt-2">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-warning">Submit</button>
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
