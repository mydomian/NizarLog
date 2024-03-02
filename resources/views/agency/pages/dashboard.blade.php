@extends('agency.layouts.master')
@section('title')
Dashboard
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 flex-column d-flex stretch-card">
            <div class="row">
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card bg-primary">
                        <div class="card-body text-white">
                            <h3 class="font-weight-bold mb-3">{{App\Models\AirBooking::where('user_id', auth()->user()->id)->count()}}</h3>
                            <div class="progress mb-3">
                                <div class="progress-bar  bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="pb-0 mb-0">Total Booking</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-diffrence-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">$6475</h2>
                            <h4 class="card-title mb-2">Sales Difference</h4>
                            <small class="text-muted">APRIL 2019</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">$3479</h2>
                            <h4 class="card-title mb-2">Visit Statistics</h4>
                            <small class="text-muted">APRIL 2019</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">$3479</h2>
                            <h4 class="card-title mb-2">Visit Statistics</h4>
                            <small class="text-muted">APRIL 2019</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-visit-statistics-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">$3479</h2>
                            <h4 class="card-title mb-2">Visit Statistics</h4>
                            <small class="text-muted">APRIL 2019</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card bg-primary">
                        <div class="card-body text-white">
                            <h3 class="font-weight-bold mb-3">18,39 (75GB)</h3>
                            <div class="progress mb-3">
                                <div class="progress-bar  bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="pb-0 mb-0">Bandwidth usage</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-diffrence-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">$6475</h2>
                            <h4 class="card-title mb-2">Sales Difference</h4>
                            <small class="text-muted">APRIL 2019</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-flex grid-margin stretch-card">
                    <div class="card sale-diffrence-border">
                        <div class="card-body">
                            <h2 class="text-dark mb-2 font-weight-bold">$6475</h2>
                            <h4 class="card-title mb-2">Sales Difference</h4>
                            <small class="text-muted">APRIL 2019</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
    </div>
</div>
@endsection
