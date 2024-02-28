@extends('agency.layouts.master')
@section('title')
Air Bill Generate
@endsection
@push('agency-css')
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
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <h5 class="text-center mt-3 text-warning">Air Bill Generate</h5>
          <div class="card-body">

            <form action="{{route('agency-air-bill.store')}}" method="post">
            @csrf
                <div class="row">
                  <label for="From">From:</label>
                  <div class="col">
                    <input type="text" name="from_name" class="form-control border-warning @error('from_name') is-invalid @enderror" placeholder="Form Name" data-toggle="tooltip" data-placement="top" title="Form Name" required>
                  </div>
                  <div class="col">
                    <input type="number" name="from_number" class="form-control border-warning @error('from_number') is-invalid @enderror" placeholder="From Nubmer" data-toggle="tooltip" data-placement="top" title="From Nubmer" required>
                  </div>
                  <div class="col">
                    <input type="text" name="from_address" class="form-control border-warning @error('from_address') is-invalid @enderror" placeholder="From Address" data-toggle="tooltip" data-placement="top" title="From Address" required>
                  </div>
                </div>
                <div class="row mt-3">
                    <label for="From">To:</label>
                  <div class="col">
                    <input type="text" name="to_name" class="form-control border-warning @error('to_name') is-invalid @enderror" placeholder="To Name" data-toggle="tooltip" data-placement="top" title="To Name" required>
                  </div>
                  <div class="col">
                    <input type="number" name="to_number" class="form-control border-warning @error('to_number') is-invalid @enderror" placeholder="To Nubmer" data-toggle="tooltip" data-placement="top" title="To Nubmer" required>
                  </div>
                  <div class="col">
                    <input type="text" name="to_address" class="form-control border-warning @error('to_address') is-invalid @enderror" placeholder="To Address" data-toggle="tooltip" data-placement="top" title="To Address" required>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-4">
                    <select  class="js-example-basic-single @error('last_destination_id') is-invalid @enderror" name="last_destination_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Destination" required>
                        <option value="">Select Destination</option>
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->id }}">{{ $hub->hub_name }} ({{ $hub->hub_code }})</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                    <label for="From">Package and Delivery Detail:</label>
                  <div class="col">
                    <select id="area_type_id" class="js-example-basic-single @error('area_type_id') is-invalid @enderror" name="area_type_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Area Type" required>
                        <option value="">Select Area Type</option>
                        @foreach ($areaTypes as $areaType)
                            <option value="{{ $areaType->id }}">{{ $areaType->type }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <select id="parcel_type_id" class="js-example-basic-single @error('parcel_type_id') is-invalid @enderror" name="parcel_type_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Parcal Type" required>
                        <option value="">Select Parcel Type</option>
                        @foreach ($parcelTypes as $parcelType)
                            <option value="{{ $parcelType->id }}">{{ $parcelType->type }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                    <select id="delivery_type_id" class="js-example-basic-single @error('delivery_type_id') is-invalid @enderror" name="delivery_type_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Delivery Type" required>
                        <option value="">Select Delivery Type</option>
                        @foreach ($deliveryTypes as $deliveryType)
                            <option value="{{ $deliveryType->id }}">{{ $deliveryType->type }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <select id="delivery_charge_id" class="js-example-basic-single delivery_charge_id @error('delivery_charge_id') is-invalid @enderror" name="delivery_charge_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Weight Type" required>
                        <option value="">Select Weight Type</option>
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                     <textarea name="product_details" class="form-control border-warning @error('parcel_type_id') is-invalid @enderror" placeholder="Product Details" id="" style="height: 45px;" data-toggle="tooltip" data-placement="top" title="Product Details" required></textarea>
                  </div>
                  <div class="col">
                    <input type="number" name="product_amount" class="form-control product_amount border-warning @error('product_amount') is-invalid @enderror" id="product_amount" placeholder="Product Amount" data-toggle="tooltip" data-placement="top" title="Product Amount">
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col">
                     <input name="collection_amount" class="form-control border-warning collection_amount @error('collection_amount') is-invalid @enderror" placeholder="Collection Amount" style="height: 45px;" data-toggle="tooltip" data-placement="top" title="Collection Amount" required>
                  </div>
                  <div class="col">
                    <textarea name="spacial_instruction" class="form-control border-warning @error('spacial_instruction') is-invalid @enderror" placeholder="Spacial Instruction" style="height: 45px;" data-toggle="tooltip" data-placement="top" title="Spacial Instruction" required></textarea>
                  </div>
                </div>
                <div class="row mt-4">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-md btn-warning">Booking Order</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
            <h5 class="text-center mt-3 text-warning">Cost Management</h5>
            <div class="card-body">
                <table style="width:100%" class="text-center">
                    <tr class="bg-warning">
                      <th class="py-3">Cost Management</th>
                      <th class="py-3">Charge</th>
                    </tr>
                    <tr>
                      <td>Delivery Charge</td>
                      <td class="delivery_charge_value">00.00</td>
                    </tr>
                    <tr>
                      <td>COD Charge</td>
                      <td class="cod_charge_value">00.00</td>
                    </tr>
                    <tr>
                      <td>Total Charge</td>
                      <td class="total_charge_value">00.00</td>
                    </tr>
                    <tr class="bg-success text-white">
                        <th class="py-2">Receivable Amount (Merchant)</th>
                        <th class="py-2 receivable_amount_merchant">00.00</th>
                      </tr>
                  </table>
            </div>
        </div>
        <div class="card mt-3">
            <h5 class="text-center mt-3 text-warning">Pickup Notice</h5>
            <div class="card-body">
                <strong class="text-danger">Urgent</strong> = Same day pick-up & Delivery within 8 hrs upto 9.00 pm in City.<br><br>
                <strong class="text-danger">Regular</strong> = Next day delivery within 24 hrs in City.
            </div>
        </div>
      </div>
    </div>
</div>

@endsection
@push('agency-scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $("#delivery_type_id").change(function() {
            var deliveryTypeValue = $(this).val();
            var areaTypeValue = $('#area_type_id').find(':selected').val();
            var parcelTypeValue = $('#parcel_type_id').find(':selected').val();

            if(deliveryTypeValue == '' || areaTypeValue == '' || parcelTypeValue == ''){
                alert('Please Select Delivery Type, Area Type, Parcel Type');
            }
            $.ajax({
                    method: "get",
                    url: "{{ route('agency.delivery-type-wise-delivery-charge') }}",
                    data: {
                        deliveryTypeValue:deliveryTypeValue,areaTypeValue:areaTypeValue,parcelTypeValue:parcelTypeValue
                    },
                    success: function(response) {
                        $('.delivery_charge_id').empty().append('<option value="">Select Weight Type</option>');
                        $.each(response, function (index, item) {
                            $('.delivery_charge_id').append('<option value="' + item.id + '">' + item.weight +' (' +item.delivery_charge+ ') '+'</option>');
                        });
                    },
                    error: function(response) {
                        console.log(response);
                    }
            });
        });

        $("#delivery_charge_id").change(function() {
            var deliveryChargeValue = $(this).val();
            $.ajax({
                    method: "get",
                    url: "{{ route('agency.delivery-charge-wise-cod-charge') }}",
                    data: {
                        deliveryChargeValue:deliveryChargeValue
                    },
                    success: function(response) {
                        $('.delivery_charge_value').html(response.delivery_charge);
                    },
                    error: function(response) {
                        console.log(response);
                    }
            });
        });

        $('#product_amount').keyup(function() {
            var totalChargeId = $('#delivery_charge_id').val();
            var productAmount = $(this).val();

            $.ajax({
                    method: "get",
                    url: "{{ route('agency.cod-charge') }}",
                    data: {
                        totalChargeId:totalChargeId,
                        productAmount:productAmount
                    },
                    success: function(response) {
                        $('.cod_charge_value').html(response.percentageAmount);
                        $('.total_charge_value').html(response.percentageAmount+response.deliveryCharge);
                    },
                    error: function(response) {
                        console.log(response);
                    }
            });

        });

        $('.collection_amount').keyup(function() {
            var totalChargeValue = $('.total_charge_value').text();
            var collectionAmount = $(this).val();

            var recievableAmount = collectionAmount - totalChargeValue;
            $('.receivable_amount_merchant').html(recievableAmount)

        });

    });
</script>
{{-- <script>
  @if (session()->has('print'))
    $(document).ready(function(){
      var airbooking = {{session()->get('print')}}
      var url = "agency-air-booking-print/"+airbooking;
      window.location = window.open(url, "_blank");
    })
  @endif
</script> --}}
@endpush
