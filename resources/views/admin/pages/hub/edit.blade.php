@extends('admin.layouts.master')
@section('title')
Hub Edit
@endsection

@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Edit Hub</h5>
          <div class="card-body">

            <form action="{{ route('admin-hubs.update',$hub->id) }}" method="post">
            @csrf
            @method('put')
                <div class="row">
                  <div class="col">
                    <input type="text" name="hub_name" class="form-control border-warning @error('hub_name') is-invalid @enderror" placeholder="Hub Name" value="{{ $hub->hub_name }}" data-toggle="tooltip" data-placement="top" title="Hub Name">
                  </div>

                </div>
                <div class="row mt-2">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-warning">Update</button>
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
