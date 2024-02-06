@extends('admin.layouts.master')
@section('title')
Agencies Lists
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
            <h5 class=" mt-3 text-warning">Agencies Lists</h5>
          </div>
          <div class="card-body">

            <div class="driver-append">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                            <th class="text-primary">SL</th>
                            <th class="text-primary">Name</th>
                            <th class="text-primary">Email</th>
                            <th class="text-primary">Phone</th>
                            <th class="text-primary">Photo</th>
                            <th class="text-primary">Address</th>
                            <th class="text-primary">Area</th>
                            <th class="text-primary">Pin</th>
                            <th class="text-primary">Licence</th>
                            <th class="text-primary">Status</th>
                            <th class="text-primary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agencies as $agency)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $agency->name ?? '-' }}</td>
                            <td>{{ $agency->email ?? '-' }}</td>
                            <td>{{ $agency->user_info->phone ?? '-' }}</td>
                            <td><img style="width:32px height:32px;" src="@if($agency->profile_photo_path) {{ asset('/storage/profile/'.$agency->profile_photo_path) }} @else {{ asset('/storage/profile/avatar.png') }} @endif" alt="profile-image"></td>
                            <td>{{ $agency->user_info->address ?? '-' }}</td>
                            <td>{{ $agency->user_info->service_area ?? '-' }}</td>
                            <td>{{ $agency->user_info->pin ?? '-' }}</td>
                            <td><a href="{{ asset('/storage/licence/'.$agency->user_info->cv) }}" target="_blank">view cv</a></td>
                            <td><span class="badge badge-info">{{ $agency->status }}</span></td>
                            <td>
                                <a href="{{ route('admin-agencies.edit',$agency->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text sa-active-{{ $agency->id }}" dataRoute="{{ route('admin.agencies.status',$agency->id) }}" status="active" data-toggle="tooltip" data-placement="top" title="Active">
                                    <i class="mdi mdi-account-check"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text  sa-inactive-{{ $agency->id }}" dataRoute="{{ route('admin.agencies.status',$agency->id) }}" status="inactive" data-toggle="tooltip" data-placement="top" title="Inactive">
                                    <i class="mdi mdi-account-off"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text  sa-suspend-{{ $agency->id }}" dataRoute="{{ route('admin.agencies.status',$agency->id) }}" status="suspend" data-toggle="tooltip" data-placement="top" title="Suspend">
                                    <i class="mdi mdi-account-remove"></i>
                                </a>
                            </td>
                        </tr>

                            @push('admin-scripts')
                                <script>
                                $('.sa-active-{{ $agency->id }}, .sa-inactive-{{ $agency->id }}, .sa-suspend-{{ $agency->id }}').on('click', function () {
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
