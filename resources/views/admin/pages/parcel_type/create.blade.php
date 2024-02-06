@extends('admin.layouts.master')
@section('title')
Parcel Type Add
@endsection

@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Parcel Type</h5>
          <div class="card-body">

            <form action="{{ route('admin-parcel-types.store') }}" method="post">
            @csrf
                <div class="row">
                  <div class="col">
                    <input type="text" name="type" class="form-control border-warning @error('type') is-invalid @enderror" placeholder="Parcel Type" data-toggle="tooltip" data-placement="top" title="Parcel Type">
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
