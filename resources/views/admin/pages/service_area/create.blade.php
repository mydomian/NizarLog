@extends('admin.layouts.master')
@section('title')
Service Area Add
@endsection

@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Add Service Area</h5>
          <div class="card-body">

            <form action="{{ route('service-areas.store') }}" method="post">
            @csrf
                <div class="row">
                  <div class="col">
                    <input type="text" name="name" class="form-control border-warning @error('name') is-invalid @enderror" placeholder="Area Name" data-toggle="tooltip" data-placement="top" title="Area Name">
                  </div>
                  <div class="col">
                    <input type="text" name="code" class="form-control border-warning @error('code') is-invalid @enderror" placeholder="Area Code" data-toggle="tooltip" data-placement="top" title="Area Code">
                  </div>
                </div>
                <div class="row mt-2">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-sm btn-warning">Submit</button>
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
