@extends('admin.layouts.master')
@section('title')
Booking Show
@endsection
@push('admin-links-css')

@endpush
@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-7">
        <div class="card">

          <div class="card-body">
            <div class="text-center d-flex justify-content-between">
                <h5 class="mt-3 text-warning">Booking Show</h5>
                <a href="{{ route('admin-air-bills.index') }}" class="mt-3 btn btn-primary text-warning"><i class="mdi mdi-arrow-left-bold"></i> Booking Lists</a>
            </div>
            <div class="service-delivery-append mt-3">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <tr>
                        <th>Invoice No</th>
                        <td>{{ $airBill->invoice_no ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Agency</th>
                        <td>{{ $airBill->user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Destination</th>
                        <td>{{ $airBill->hub->hub_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Area Type</th>
                        <td>{{ $airBill->area_type->type ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Parcel Type</th>
                        <td>{{ $airBill->parcel_type->type ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Delivery Type</th>
                        <td>{{ $airBill->delivery_type->type ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge</th>
                        <td>{{ $airBill->delivery_weight_charge->delivery_charge ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Product Weight</th>
                        <td>{{ $airBill->delivery_weight_charge->weight ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>From Name</th>
                        <td>{{ $airBill->from_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>From Number</th>
                        <td>{{ $airBill->from_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>From Address</th>
                        <td>{{ $airBill->from_address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>To Name</th>
                        <td>{{ $airBill->to_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>To Number</th>
                        <td>{{ $airBill->to_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>To Address</th>
                        <td>{{ $airBill->to_address ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Product Details</th>
                        <td style="width:500px;">{{ $airBill->product_details ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Product Amount</th>
                        <td>{{ $airBill->product_amount ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Collection Amount</th>
                        <td>{{ $airBill->collection_amount ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Due Amount</th>
                        <td>{{ $airBill->due_amount ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>COD Charge</th>
                        <td>60</td>
                    </tr>
                    <tr>
                        <th>Spacial Instruction</th>
                        <td style="width:800px;">{{ $airBill->spacial_instruction ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Date Time</th>
                        <td>{{ $airBill->date_time ?? '-' }}</td>
                    </tr>
                    <tr class="bg-warning">
                        <th>Staus</th>
                        <td>Pickup Pending</td>
                    </tr>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

