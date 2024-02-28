@extends('admin.layouts.master')
@section('title')
Return Lists
@endsection
@push('admin-links-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@endpush
@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12">
        <div class="card">
            <div class="text-center">
                <h5 class=" mt-3 text-warning">Return Lists</h5>
            </div>
          <div class="card-body">

            <div class="service-delivery-append">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                            <th>Id</th>
                            <th>Invoice</th>
                            <th>Agency</th>
                            <th>Destination</th>
                            <th>Driver</th>
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
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $airBooking->invoice_no ?? "-" }}</td>
                            <td>{{ $airBooking->user->name ?? "-" }}</td>
                            <td>{{ $airBooking->hub->hub_name ?? "-" }}</td>
                            <td>
                                @foreach ($airBooking->tracking as $tracking)
                                    @if(isset($tracking->driver))
                                        @if ($loop->last)
                                            <span class="badge bg-danger">{{ $tracking->driver->name }}</span>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
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
    <script>
        $(document).ready(function(){
            new DataTable('#example', {
                responsive: true
            });
        })
    </script>
@endpush
