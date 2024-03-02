@extends('agency.layouts.master')
@section('title')
Transit Receive Requests
@endsection
@push('agency-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
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
      <div class="col-md-12">
        <div class="card">
            <div class="text-center">
                <h5 class=" mt-3 text-warning">Transit Receive Requests ({{$transit_receives->count()}})</h5>
            </div>
          <div class="card-body">
            <div class="service-delivery-append">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                             <th> Sl </th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Invoice</th>
                            <th>Agency</th>
                            <th>Destination</th>
                            <th>AreaType</th>
                            <th>ParcelType</th>
                            <th>DeliveryType</th>
                            <th>DateTime</th>
                            <th>DeliveryCharge</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transit_receives as $receive)
                        <tr>
                            {{-- <td></td> --}}
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td class="d-flex gap-1">
                                {{-- <a href="{{ route('admin-air-bills.edit',$airBooking->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a> --}}
                                <a href="{{ route('agency-air-bill.show',$receive->air_booking_id) }}" type="button" class="btn btn-sm btn-outline-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Show">
                                    <i class="mdi mdi-eye"></i>
                                </a>
                                <a href="{{route('agency.airBillPrint',$receive->air_booking_id)}}" type="button" class="btn btn-sm btn-outline-success " target="_blank" data-toggle="tooltip" data-placement="top" title="Print">
                                    <i class="mdi mdi-printer"></i>
                                </a>
                               
                                <form action="{{ route('agency.tracking') }}" method="post" target="_blank">
                                    @csrf
                                    <input type="hidden" name="invoice_no" value="{{$receive->booking->invoice_no}}">
                                    <input type="hidden" name="list" value="1">
                                    <button type="submit" class="btn btn-sm btn-outline-info"  target="_blank" data-toggle="tooltip" data-placement="top" title="Track">
                                        <i class="mdi mdi-file-tree"></i>
                                    </button>
                                </form>
                            

                                <a href="{{route('agency-air-bill.received.transit', $receive->air_booking_id)}}" type="button" class="btn btn-sm  {{isReceived($receive->air_booking_id) ? 'btn-secondary disabled' :  'btn-warning'}}" data-route="{{route('agency-air-bill.received.transit', $receive->air_booking_id)}}"  data-toggle="tooltip" data-placement="top" title="Print">
                                    {{!isReceived($receive->air_booking_id) ? 'Mark as Transit Received' : 'Confirmed Transit Receive'}}
                                </a>

                            </td>
                            <td><span class="badge {{ $receive->status == 'transit_delivered' ? 'badge-danger' :  'badge-outline-success' }} text-uppercase">{{ $receive->status }}</span></td>
                            <td>{{ $receive->booking->invoice_no ?? "-" }}</td>
                            <td>{{ $receive->booking->user->name ?? "-" }}</td>
                            <td>{{ $receive->booking->hub->hub_name ?? "-" }}</td>
                            <td>{{ $receive->booking->area_type->type ?? "-" }}</td>
                            <td>{{ $receive->booking->parcel_type->type ?? "-" }}</td>
                            <td>{{ $receive->booking->delivery_type->type ?? "-" }}</td>
                            <td>{{ $receive->booking->date_time ?? "-" }}</td>
                            <td>{{ $receive->booking->delivery_weight_charge->delivery_charge ?? "-" }}</td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('agency-scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){

            $('.js-example-basic-single').select2();
            new DataTable('#example', {
                responsive: true
            });


            $("#checkall").click(function (){
                if ($("#checkall").is(':checked')){
                    $(".checkboxes").each(function (){
                        $(this).prop("checked", true);
                    });
                }else{
                    $(".checkboxes").each(function (){
                        $(this).prop("checked", false);
                    });
                }
            });

        })
    </script>
@endpush
