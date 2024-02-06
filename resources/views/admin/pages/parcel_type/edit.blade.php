@extends('admin.layouts.master')
@section('title')
Parcel Edit
@endsection

@section('content')

<div class="content-wrapper">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <div class="card">
        <h5 class="text-center mt-3 text-warning">Edit Parcel Type</h5>
          <div class="card-body">

            <form action="{{ route('admin-parcel-types.update',$parcelType->id) }}" method="post">
            @csrf
            @method('put')
                <div class="row">
                  <div class="col">
                    <input type="text" name="type" class="form-control border-warning @error('type') is-invalid @enderror" placeholder="Parcel Type" value="{{ $parcelType->type }}" data-toggle="tooltip" data-placement="top" title="Parcel Type">
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
