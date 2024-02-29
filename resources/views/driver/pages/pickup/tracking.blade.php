@extends('driver.layouts.master')
@section('title')
    Track Parcel
@endsection
@push('links-css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        html,
        body {
            background-color: #222C32;
            height: 100%;
            font-family: 'Open Sans', sans-serif;
            box-sizing: border-box;
        }

        .cd-container {
            width: 90%;
            max-width: 1080px;
            margin: 0 auto;
            background: #fff;
            /*2B343A */
            padding: 0 10%;
            border-radius: 2px;
        }

        .cd-container::after {
            content: '';
            display: table;
            clear: both;
        }

        /* --------------------------------

        Main components

        -------------------------------- */


        #cd-timeline {
            position: relative;
            padding: 2em 0;
            margin-top: 2em;
            margin-bottom: 2em;
        }

        #cd-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 25px;
            height: 100%;
            width: 4px;
            background: #7E57C2;
        }

        @media only screen and (min-width: 1170px) {
            #cd-timeline {
                margin-top: 3em;
                margin-bottom: 3em;
            }

            #cd-timeline::before {
                left: 50%;
                margin-left: -2px;
            }
        }

        .cd-timeline-block {
            position: relative;
            margin: 2em 0;
        }

        .cd-timeline-block:after {
            content: "";
            display: table;
            clear: both;
        }

        .cd-timeline-block:first-child {
            margin-top: 0;
        }

        .cd-timeline-block:last-child {
            margin-bottom: 0;
        }

        @media only screen and (min-width: 1170px) {
            .cd-timeline-block {
                margin: 4em 0;
            }

            .cd-timeline-block:first-child {
                margin-top: 0;
            }

            .cd-timeline-block:last-child {
                margin-bottom: 0;
            }
        }

        .cd-timeline-img {
            position: absolute;
            top: 8px;
            left: 12px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            box-shadow: 0 0 0 4px #7E57C2, inset 0 2px 0 rgba(0, 0, 0, 0.08), 0 3px 0 4px rgba(0, 0, 0, 0.05);
        }

        .cd-timeline-img {
            background: #673AB7;
        }

        @media only screen and (min-width: 1170px) {
            .cd-timeline-img {
                width: 30px;
                height: 30px;
                left: 50%;
                margin-left: -15px;
                margin-top: 15px;
                /* Force Hardware Acceleration in WebKit */
                -webkit-transform: translateZ(0);
                -webkit-backface-visibility: hidden;
            }
        }

        .cd-timeline-content {
            position: relative;
            margin-left: 60px;
            margin-right: 30px;
            background: #333C42;
            border-radius: 2px;
            padding: 1em;

            .timeline-content-info {
                background: #2B343A;
                padding: 5px 10px;
                color: rgba(255, 255, 255, 0.7);
                font-size: 12px;
                box-shadow: inset 0 2px 0 rgba(0, 0, 0, 0.08);
                border-radius: 2px;

                i {
                    margin-right: 5px;
                }

                .timeline-content-info-title,
                .timeline-content-info-date {
                    width: calc(50% - 2px);
                    display: inline-block;
                }

                @media (max-width: 500px) {

                    .timeline-content-info-title,
                    .timeline-content-info-date {
                        display: block;
                        width: 100%;
                    }
                }
            }

            .content-skills {
                font-size: 12px;
                padding: 0;
                margin-bottom: 0;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;

                li {
                    background: #40484D;
                    border-radius: 2px;
                    display: inline-block;
                    padding: 2px 10px;
                    color: rgba(255, 255, 255, 0.7);
                    margin: 3px 2px;
                    text-align: center;
                    flex-grow: 1;
                }
            }
        }

        .cd-timeline-content:after {
            content: "";
            display: table;
            clear: both;
        }

        .cd-timeline-content h2 {
            color: rgba(255, 255, 255, .9);
            margin-top: 0;
            margin-bottom: 5px;
        }

        .cd-timeline-content p,
        .cd-timeline-content .cd-date {
            color: rgba(255, 255, 255, .7);
            font-size: 13px;
            font-size: 0.8125rem;
        }

        .cd-timeline-content .cd-date {
            display: inline-block;
        }

        .cd-timeline-content p {
            margin: 1em 0;
            line-height: 1.6;
        }

        .cd-timeline-content::before {
            content: '';
            position: absolute;
            top: 16px;
            right: 100%;
            height: 0;
            width: 0;
            border: 7px solid transparent;
            border-right: 7px solid #333C42;
        }

        @media only screen and (min-width: 768px) {
            .cd-timeline-content h2 {
                font-size: 20px;
                font-size: 1.25rem;
            }

            .cd-timeline-content p {
                font-size: 16px;
                font-size: 1rem;
            }

            .cd-timeline-content .cd-read-more,
            .cd-timeline-content .cd-date {
                font-size: 14px;
                font-size: 0.875rem;
            }
        }

        @media only screen and (min-width: 1170px) {
            .cd-timeline-content {
                color: white;
                margin-left: 0;
                padding: 1.6em;
                width: 36%;
                margin: 0 5%
            }

            .cd-timeline-content::before {
                top: 24px;
                left: 100%;
                border-color: transparent;
                border-left-color: #333C42;
            }

            .cd-timeline-content .cd-date {
                position: absolute;
                width: 100%;
                left: 122%;
                top: 6px;
                font-size: 16px;
                font-size: 1rem;
            }

            .cd-timeline-block:nth-child(even) .cd-timeline-content {
                float: right;
            }

            .cd-timeline-block:nth-child(even) .cd-timeline-content::before {
                top: 24px;
                left: auto;
                right: 100%;
                border-color: transparent;
                border-right-color: #333C42;
            }

            .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-read-more {
                float: right;
            }

            .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-date {
                left: auto;
                right: 122%;
                text-align: right;
            }
        }

        table,
        th,
        td {
            border: 1px solid white;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            background-color: #96D4D4;
            padding: 5px;
            color: black;
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="text-center mt-3 text-warning">Tracking</h5>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{ route('driver.tracking') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="invoice_no"
                                            class="form-control border-warning @error('invoice_no') is-invalid @enderror"
                                            placeholder="Enter Your Invoice No" data-toggle="tooltip" data-placement="top"
                                            title="Enter Your Invoice No To Track" required>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-info btn-lg w-100"><i
                                                class="mdi mdi-map-marker-radius"></i> Tracking</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (isset($airBooking))
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card">
                        <h5 class="text-center mt-3 text-warning">Tracking Result</h5>
                        <hr>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="">



                                        <table style="width:100%">
                                            <tr>
                                                <th>Invoice</th>
                                                <td>{{ $airBooking->invoice_no ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Agency</th>
                                                <td>{{ $airBooking->user->name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Agency Phone</th>
                                                <td>{{ $airBooking->user->user_info->phone ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Agency Address</th>
                                                <td>{{ $airBooking->user->user_info->address ?? '-' }}</td>

                                            </tr>
                                            <tr>
                                                <th>Customer</th>
                                                <td>{{ $airBooking->to_name ?? '-' }}</td>

                                            </tr>
                                            <tr>
                                                <th>Customer Phone</th>
                                                <td>{{ $airBooking->to_number ?? '-' }}</td>

                                            </tr>
                                            <tr>
                                                <th>Address </th>
                                                <td>{{ $airBooking->to_address ?? '-' }}</td>

                                            </tr>
                                            <tr>
                                                <th>Collection</th>
                                                <td>{{ $airBooking->collection_amount ?? '-' }}</td>

                                            </tr>
                                            <tr>
                                                <th>Due</th>
                                                <td>{{ $airBooking->due_amount ?? '-' }}</td>

                                            </tr>
                                        </table>
                                    </div>


                                    <section id="cd-timeline" class="cd-container">
                                        @foreach ($airBooking->tracking as $tracking)
                                            @if ($tracking->status == 'pickup_pending')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-picture">
                                                    </div>

                                                    <div class="cd-timeline-content">
                                                        <h2>Pickup Pending</h2>
                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($tracking->status == 'assign_delivery_man')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-movie">
                                                    </div>

                                                    <div class="cd-timeline-content">
                                                        <h2>Assign Driver</h2>
                                                        <h6>Driver Name: {{ $tracking->driver->name ?? '' }}</h6>
                                                        <p>From: {{ $tracking->booking->user->user_info->address ?? '' }}
                                                            <br>
                                                            To: {{ $tracking->toHub->hub_name ?? '' }}
                                                            ({{ $tracking->toHub->hub_code ?? '' }})
                                                        </p>

                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }} </span>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($tracking->status == 'received_pickup_pending')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-picture">
                                                    </div>

                                                    <div class="cd-timeline-content">
                                                        <h2>Pickup Pending Received By Driver</h2>
                                                        <h6>Driver Name: {{ $tracking->driver->name ?? '' }}</h6>
                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }} </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($tracking->status == 'delivery_hub')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-movie">
                                                    </div>

                                                    <div class="cd-timeline-content">
                                                        <h2>Parcel Reached In {{ $tracking->toHub->hub_name ?? '' }}
                                                            ({{ $tracking->toHub->hub_code ?? '' }})</h2>
                                                        <h6>Driver Name: {{ $tracking->driver->name ?? '' }}</h6>
                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }} </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($tracking->status == 'transit')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-picture">
                                                    </div>

                                                    <div class="cd-timeline-content">
                                                        <h2>In Transit</h2>
                                                        <h6>Driver Name: {{ $tracking->driver->name ?? '' }}</h6>
                                                        <p>From: {{ $tracking->fromHub->hub_name ?? '' }}
                                                            ({{ $tracking->fromHub->hub_code ?? '' }})<br>
                                                            To: {{ $tracking->toHub->hub_name ?? '' }}
                                                            ({{ $tracking->toHub->hub_code ?? '' }})
                                                        </p>
                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }} </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($tracking->status == 'delivery')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-movie bg-success">
                                                    </div>

                                                    <div class="cd-timeline-content bg-success">
                                                        <h2>Parcel Delivered To {{ $tracking->booking->to_address }}</h2>
                                                        <h6>Driver Name: {{ $tracking->driver->name ?? '' }}</h6>
                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }} </span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($tracking->status == 'return')
                                                <div class="cd-timeline-block">
                                                    <div class="cd-timeline-img cd-picture bg-danger">
                                                    </div>

                                                    <div class="cd-timeline-content bg-danger">
                                                        <h2>Parcel Return</h2>
                                                        <h6>Driver Name: {{ $tracking->driver->name ?? '' }}</h6>
                                                        <span class="cd-date"
                                                            style="color:chocolate">{{ $tracking->created_at }} </span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </section>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
