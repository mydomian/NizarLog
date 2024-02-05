@extends('admin.layouts.master')
@section('title')
Service Area Edit
@endsection

@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Edit Service Area</h5>
          <div class="card-body">

            <form action="{{ route('service-areas.update',$serviceArea->id) }}" method="post">
            @csrf
            @method('put')
                <div class="row">
                  <div class="col">
                    <input type="text" name="name" class="form-control border-warning @error('name') is-invalid @enderror" placeholder="Area Name" value="{{ $serviceArea->name }}" data-toggle="tooltip" data-placement="top" title="Area Name">
                  </div>
                  <div class="col">
                    <input type="number" name="code" class="form-control border-warning @error('code') is-invalid @enderror" placeholder="Area Code" value="{{ $serviceArea->code }}" data-toggle="tooltip" data-placement="top" title="Area Code">
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
