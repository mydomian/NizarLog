@extends('admin.layouts.master')
@section('title')
COD Charge Lists
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

          <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h5 class="text-center text-warning">COD Charge Lists</h5>
                <a href="{{ route('admin-cod-charge.create') }}" class="btn btn-lg btn-primary">Add COD Charge</a>
                <div></div>
            </div>
            <div class="service-delivery-append">
                <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="bg-warning">
                        <tr>
                            <th>Id</th>
                            <th>Charge Percent</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cods as $cod)
                        <tr>
                            <td>{{ $cod->id }}</td>
                            <td>{{ $cod->charge_percent ?? "-" }}</td>
                            <td>{{ $cod->type ?? "-" }}</td>
                            <td><span class="badge badge-info">{{ $cod->status }}</span></td>
                            <td>
                                <a href="{{ route('admin-cod-charge.edit',$cod->id) }}" type="button" class="btn btn-sm btn-primary btn-icon-text" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="mdi mdi-pencil-box-outline"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text sa-active-{{ $cod->id }}" dataRoute="{{ route('admin.COD.status',$cod->id) }}" status="active" data-toggle="tooltip" data-placement="top" title="Active">
                                    <i class="mdi mdi-account-check"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text  sa-inactive-{{ $cod->id }}" dataRoute="{{ route('admin.COD.status',$cod->id) }}" status="inactive" data-toggle="tooltip" data-placement="top" title="Inactive">
                                    <i class="mdi mdi-account-off"></i>
                                </a>
                                <a href="javascript:;" type="button" class="btn btn-sm btn-primary btn-icon-text  sa-suspend-{{ $cod->id }}" dataRoute="{{ route('admin.COD.status',$cod->id) }}" status="suspend" data-toggle="tooltip" data-placement="top" title="Suspend">
                                    <i class="mdi mdi-account-remove"></i>
                                </a>
                            </td>
                        </tr>

                            @push('admin-scripts')
                                <script>
                                $('.sa-active-{{ $cod->id }}, .sa-inactive-{{ $cod->id }}, .sa-suspend-{{ $cod->id }}').on('click', function () {
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