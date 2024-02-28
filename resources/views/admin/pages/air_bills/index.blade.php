@extends('admin.layouts.master')
@section('title')
Pickup Pending Lists
@endsection
@push('admin-links-css')
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
                <h5 class=" mt-3 text-warning">Pickup Pending Lists</h5>
            </div>
        <form action="{{ route('adminListsPickupReceived') }}" method="post">
        @csrf
          <div class="card-body">
            <div class="row mb-3">

                    <div class="form-row">
                      <div class="col">
                        <select id="driver_id" class="js-example-basic-single @error('driver_id') is-invalid @enderror" name="driver_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Select Driver" required>
                            <option value="">Select Driver</option>

                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <select id="to_hub_id" class="js-example-basic-single @error('to_hub_id') is-invalid @enderror" name="to_hub_id" style="width:100%" data-toggle="tooltip" data-placement="top" title="Select Hub" required>
                            <option value="">Select Hub</option>

                            @foreach ($hubs as $hub)
                                <option value="{{ $hub->id }}">{{ $hub->hub_name }} - ({{ $hub->hub_code }} - {{ $hub->hub_parent == null ? 'Parent' :  $hub->hub_parent}})</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="col d-flex align-items-center">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-plus"></i>Save</button>
                      </div>
                    </div>

            </div>
            <div class="service-delivery-append">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                            <th></th>

                            <th>
                                Sl
                                <input id="checkall" class='' type="checkbox" >
                            </th>
                            <th>Invoice</th>
                            <th>Agency</th>
                            <th>Destination</th>
                            <th>AreaType</th>
                            <th>ParcelType</th>
                            <th>DeliveryType</th>
                            <th>DateTime</th>
                            <th>DeliveryCharge</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airBookings as $airBooking)
                        <tr>
                            <td></td>
                            <td>
                                {{$loop->iteration}}
                                <input  class="checkboxes" type="checkbox" value="{{ $airBooking->id }}" name="ids[]" id="">
                            </td>
                            <td>{{ $airBooking->invoice_no ?? "-" }}</td>
                            <td>{{ $airBooking->user->name ?? "-" }}</td>
                            <td>{{ $airBooking->hub->hub_name ?? "-" }}</td>
                            <td>{{ $airBooking->area_type->type ?? "-" }}</td>
                            <td>{{ $airBooking->parcel_type->type ?? "-" }}</td>
                            <td>{{ $airBooking->delivery_type->type ?? "-" }}</td>
                            <td>{{ $airBooking->date_time ?? "-" }}</td>
                            <td>{{ $airBooking->delivery_weight_charge->delivery_charge ?? "-" }}</td>
                            <td><span class="badge badge-info">{{ $airBooking->status }}</span></td>
                            <td>
                                <a href="{{ route('admin-air-bills.edit',$airBooking->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <a href="{{ route('admin-air-bills.show',$airBooking->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Show">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                            </td>
                        </tr>

                            @push('admin-scripts')
                                <script>
                                $('.sa-active-{{ $airBooking->id }}, .sa-inactive-{{ $airBooking->id }}, .sa-suspend-{{ $airBooking->id }}').on('click', function () {
                                    let status = $(this).attr('status');
                                    let route = $(this).attr('dataRoute');

                                    swal({
                                        title: "Are you sure?",
                                        text: "Do you want to status " +status,
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                url: route,
                                                method: "post",
                                                data: {
                                                    status: status
                                                },
                                                success: function(res) {
                                                    console.log(res);
                                                    if (res.success == true) {
                                                        swal({
                                                            title: "Status Updated Successfull",
                                                            icon: "success",
                                                            buttons: true,
                                                            dangerMode: true,
                                                        }).then((willDel)=>{
                                                            window.location.reload();
                                                        });
                                                    }

                                                }
                                            })
                                        }
                                    });
                                })
                                </script>

                            @endpush
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('admin-scripts')
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
            // var values = function() {
            //     var a = [];
            //     $(".checkboxes:checked").each(function() {
            //         a.push(this.value);
            //     });
            //     console.log(a);
            // };
        })
    </script>
@endpush
