@extends('driver.layouts.master')
@section('title')
    Pickup Requests
@endsection
@push('links-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="text-center d-flex justify-content-between p-3">
                        <h5 class=" text-warning">Pickup Requests <span class="fw-bold text-danger">({{$pickup_requests->count()}})</span></h5>
                        <button class="btn btn-danger bulk_btn btn-sm d-none" data-route="{{route('bulk.parcel.picked.up')}}">Mark selected as Picked</button>
                    </div>
                    <div class="card-body">

                        <div class="service-delivery-append">
                            <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead class="bg-warning">
                                <tr>
                                    <th>
                                        <div class="form-check form-check-success" style="margin: 0px; padding: 0px">
                                            <label class="form-check-label" style="margin: 0px; width: 20px">
                                                <input type="checkbox" class="form-check-input" id="trackings">
                                            </label>
                                        </div>
                                    </th>
                                    <th>Sl.</th>
                                    <th>Booking Id</th>
                                    <th>Driver</th>
                                    <th>From Hub Id</th>
                                    <th>To Hub Id</th>
                                    <th>Destination</th>
                                    <th>Instruction</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pickup_requests as $pickup)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-success" style="margin: 0px; padding: 0px">
                                                <label class="form-check-label" style="margin: 0px; width: 20px">
                                                    <input type="checkbox" class="form-check-input trackings" name="ids[]" data-id="{{$pickup->air_booking_id}}">
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $pickup->air_booking_id ?? "-" }}</td>
                                        <td>{{ $pickup->driver->name ?? "-" }}</td>
                                        <td>{{ $pickup->from_hub_id ?? "-" }}</td>
                                        <td>{{ $pickup->to_hub_id ?? "-" }}</td>
                                        <td>{{ $pickup->destination_address ?? "-" }}</td>
                                        <td>{{ $pickup->booking->spacial_instruction ?? "-" }}</td>
                                        <td>
                                            <label class="badge badge-outline-danger">Pending</label>
                                        </td>
                                        <td>
                                            <a href="javascript:;"  type="button" class="btn btn-sm btn-success btn-icon-text received-{{$pickup->id}}" data-route="{{route('parcel.picked.up', $pickup->air_booking_id)}}" data-toggle="tooltip" data-placement="top" title="Mark as Picked">
                                                <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                                                <small class="mx-1">Mark as Picked</small>
                                            </a>
                                        </td>
                                    </tr>
                                    @push('scripts')
                                        <script>

                                            $('.received-{{ $pickup->id }}').on('click', function () {
                                                let route = $(this).data('route');
                                                swal({
                                                    title: "Parcel Received?",
                                                    text: "You won\'t be able to revert this!",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,
                                                }).then((result) => {
                                                      if (result === true) {
                                                          window.location.href = route;
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
@push('scripts')
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

            $('#trackings').on('click', function () {
                if(this.checked){
                    $('.trackings').each(function(){
                        this.checked = true
                        $('.bulk_btn').removeClass('d-none')
                    })
                }else{
                    $('.trackings').each(function(){
                        this.checked = false
                        $('.bulk_btn').addClass('d-none')
                    })
                }
            })

            $('.trackings').on('click', function () {
                if(this.checked){
                    $('.bulk_btn').removeClass('d-none')
                }
                if($('.trackings:checked').length == 0){
                    $('.bulk_btn').addClass('d-none')
                }
                if($('.trackings:checked').length == $('.trackings').length){
                    $('#trackings').prop('checked', true)
                }else{
                    $('#trackings').prop('checked', false)
                }
            })

            $('.bulk_btn').on('click', function(e) {
                e.preventDefault();
                let ids =[];
                $('.trackings:checked').each(function(){
                    ids.push($(this).data('id'));
                });
                let id = ids.join(',');
                let route = $(this).data('route')+'?ids='+id;
                console.log(route)
                swal({
                    title: "All Parcel Picked?",
                    text: "You won\'t be able to revert these!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result === true) {
                        window.location.href = route;
                    }
                });
            })
        })
    </script>
@endpush
