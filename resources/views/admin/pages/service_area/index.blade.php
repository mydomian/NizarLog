@extends('admin.layouts.master')
@section('title')
Service Area Lists
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
                <h5 class=" mt-3 text-warning">Service Area Lists</h5>
            </div>
          <div class="card-body">

            <div class="service-area-append">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceAreas as $serviceArea)
                        <tr>
                            <td>{{ $serviceArea->id }}</td>
                            <td>{{ $serviceArea->name ?? "-" }}</td>
                            <td>{{ $serviceArea->code ?? "-" }}</td>
                            <td><span class="badge badge-info">{{ $serviceArea->status }}</span></td>
                            <td>
                                <a href="{{ route('service-areas.edit',$serviceArea->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text sa-active-{{ $serviceArea->id }}" dataRoute="{{ route('admin.serviceArea.status',$serviceArea->id) }}" status="active" data-toggle="tooltip" data-placement="top" title="Active">
                                    <i class="mdi mdi-account-check"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text  sa-inactive-{{ $serviceArea->id }}" dataRoute="{{ route('admin.serviceArea.status',$serviceArea->id) }}" status="inactive" data-toggle="tooltip" data-placement="top" title="Inactive">
                                    <i class="mdi mdi-account-off"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text  sa-suspend-{{ $serviceArea->id }}" dataRoute="{{ route('admin.serviceArea.status',$serviceArea->id) }}" status="suspend" data-toggle="tooltip" data-placement="top" title="Suspend">
                                    <i class="mdi mdi-account-remove"></i>
                                </a>
                            </td>
                        </tr>

                            @push('admin-scripts')
                                <script>
                                $('.sa-active-{{ $serviceArea->id }}, .sa-inactive-{{ $serviceArea->id }}, .sa-suspend-{{ $serviceArea->id }}').on('click', function () {
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