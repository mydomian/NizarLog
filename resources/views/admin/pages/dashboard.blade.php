@extends('admin.layouts.master')
@section('title')
Dashboard
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 flex-column d-flex stretch-card">
            <div class="row">


                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ pickup_pending() }}</h2>
                            <h4 class="card-title mb-2">Pickup Pending</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ assign_driver() }}</h2>
                            <h4 class="card-title mb-2">Assign Driver</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ received_pickup_pending() }}</h2>
                            <h4 class="card-title mb-2">Pickup Received</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ delivery_hub() }}</h2>
                            <h4 class="card-title mb-2">Hub Store</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ transit() }}</h2>
                            <h4 class="card-title mb-2">Transit</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ delivery() }}</h2>
                            <h4 class="card-title mb-2">Delivered</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ return_percel() }}</h2>
                            <h4 class="card-title mb-2">Return</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ total_agency() }}</h2>
                            <h4 class="card-title mb-2">Total Agency</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">{{ total_driver() }}</h2>
                            <h4 class="card-title mb-2">Total Driver</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Support Tracker</h4>
                        <h4 class="text-success font-weight-bold">Tickets<span class="text-dark ms-3">163</span></h4>
                    </div>
                    <div id="support-tracker-legend" class="support-tracker-legend"></div>
                    <canvas id="supportTracker"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title">Best Sellers</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <ul class="graphl-legend-rectangle">
                                <li><span class="bg-danger"></span>Automotive</li>
                                <li><span class="bg-warning"></span>Books</li>
                                <li><span class="bg-info"></span>Software</li>
                                <li><span class="bg-success"></span>Video games</li>
                            </ul>
                        </div>
                        <div class="col-sm-9 grid-margin">
                            <canvas id="bestSellers"></canvas>
                        </div>
                    </div>
                    <p class="mt-3 mb-4 mb-lg-0">Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit.
                    </p>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
