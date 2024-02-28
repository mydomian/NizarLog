<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="siQAzC5MB0KAaw3OMNuipUFVbuRGJiPjNXzStNzI">
    <title> Invoice - {{ $airBill->invoice_no }} - {{ settings()->name }} </title>
    <!--favicon-->
    <link rel="icon" type="image/png" href="{{ asset('storage/favicon.png') }}" />

    <style>
        body {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <div align="center">
        <table width="1000" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <!-- INVOICE 1 -->

                    <table width="1000" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="center" valign="middle">
                                    <table width="100%" height="100" border="0" cellpadding="0" cellspacing="0"
                                        style="border-bottom:1px solid #f3732e;">
                                        <tr>
                                            <td width="350" align="left" valign="middle">
                                                <img src="{{ asset('/storage/logo.png') }}">
                                            </td>
                                            <td width="300" align="center" valign="middle"
                                                style="font-weight:bold;font-size:24px;">
                                                Office Copy
                                            </td>
                                            <td width="350" align="center" valign="middle">
                                                <div align="right">House : {{ settings()->address }} <br>
                                                    Hotline : {{ settings()->phone }}
                                                    <br>
                                                    E-Mail : {{ settings()->email }}
                                                    <br>
                                                    Web : {{ Request::root() }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="250" height="50" align="left" valign="middle">
                                                Booking ID : {{ $airBill->invoice_no }} </td>
                                            <td align="center" valign="middle">
                                                Booking Date : {{ $airBill->date_time }}</td>
                                            <td align="center" valign="middle">

                                                   @if ($airBill->delivery_type_id == 1)
                                                    Delivery Date : {{ Carbon\Carbon::parse($airBill->date_time)->addHour(48) }}
                                                   @elseif ($airBill->delivery_type_id == 2)
                                                    Delivery Date : {{ Carbon\Carbon::parse($airBill->date_time)->addHour(24) }}
                                                   @endif

                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td width="250" height="50" align="left" valign="middle">

                                            </td>
                                            <td align="center" valign="middle">

                                            </td>
                                            <td align="center" valign="middle">

                                                Booking Status
                                                Return Reson

                                            </td>
                                        </tr> --}}


                                        <tr>
                                            <td height="80" align="left" valign="middle">


                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>

                                                            {!! QrCode::size(120)->generate($airBill->invoice_no); !!}
                                                        </td>
                                                        <td>
                                                            Status <br> <b> @if($airBill->status == 'pickup_pending') Pick-up Pending  @endif </b>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Total Collection Amount
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    {{ $airBill->collection_amount ?? '' }} </span>
                                            </td>


                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Area
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    {{ $airBill->hub->hub_name ?? '' }} ({{ $airBill->hub->hub_code ?? '' }}) </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="top" style="padding:5px;">
                                                Package : {{ $airBill->area_type->type ?? '' }}
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                {{ $airBill->parcel_type->type ?? '' }} {{ $airBill->delivery_type->type ?? '' }}
                                                {{ $airBill->delivery_weight_charge->weight ?? '' }}
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Product Details : {{ $airBill->product_details ?? '' }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="middle" style="border-bottom:1px solid #f3732e;">

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="500" height="30" align="left" valign="middle">
                                                Merchant : {{ $airBill->user->name ?? '' }} </td>
                                            <td width="500" height="30" align="left" valign="middle">
                                                To : {{ $airBill->to_name ?? '' }} </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">
                                                Address : @if(isset($airBill->user->user_info)) {{ $airBill->user->user_info->address }} @else No @endif</td>
                                            <td height="30" align="left" valign="middle">
                                                Address : {{ $airBill->to_address }} </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">Phone :
                                                @if(isset($airBill->user->user_info)) {{ $airBill->user->user_info->phone }} @else No @endif
                                            <td height="30" align="left" valign="middle">Phone :
                                                {{ $airBill->to_number ?? '' }} </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- INVOICE 1 -->
                </td>
            </tr>
            <tr>
                <td height="30" style="border-bottom:1px dotted #000;">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <!-- INVOICE 2 -->
                    <table width="1000" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="center" valign="middle">
                                    <table width="100%" height="100" border="0" cellpadding="0" cellspacing="0"
                                        style="border-bottom:1px solid #f3732e;">
                                        <tr>
                                            <td width="350" align="left" valign="middle">
                                                <img src="{{ asset('/storage/logo.png') }}">
                                            </td>
                                            <td width="300" align="center" valign="middle"
                                                style="font-weight:bold;font-size:24px;">
                                                Delivery Copy
                                            </td>
                                            <td width="350" align="center" valign="middle">
                                                <div align="right">House : {{ settings()->address }} <br>
                                                    Hotline : {{ settings()->phone }}
                                                    <br>
                                                    E-Mail : {{ settings()->email }}
                                                    <br>
                                                    Web : {{ Request::root() }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="250" height="50" align="left" valign="middle">
                                                Booking ID : {{ $airBill->invoice_no }} </td>
                                            <td align="center" valign="middle">
                                                Booking Date : {{ $airBill->date_time }}</td>
                                            <td align="center" valign="middle">


                                                   @if ($airBill->delivery_type_id == 1)
                                                   Delivery Date : {{ Carbon\Carbon::parse($airBill->date_time)->addHour(48) }}
                                                  @elseif ($airBill->delivery_type_id == 2)
                                                   Delivery Date : {{ Carbon\Carbon::parse($airBill->date_time)->addHour(24) }}
                                                  @endif

                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td width="250" height="50" align="left" valign="middle">

                                            </td>
                                            <td align="center" valign="middle">

                                            </td>
                                            <td align="center" valign="middle">

                                                Booking Status
                                                Return Reson

                                            </td>
                                        </tr> --}}


                                        <tr>
                                            <td height="80" align="left" valign="middle">


                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>

                                                            {!! QrCode::size(120)->generate($airBill->invoice_no); !!}
                                                        </td>
                                                        <td>
                                                            Status <br> <b> @if($airBill->status == 'pickup_pending') Pick-up Pending  @endif </b>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Total Collection Amount
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    {{ $airBill->collection_amount ?? '' }} </span>
                                            </td>


                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Area
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    {{ $airBill->hub->hub_name ?? '' }} ({{ $airBill->hub->hub_code ?? '' }}) </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="top" style="padding:5px;">
                                                Package : {{ $airBill->area_type->type ?? '' }}
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                {{ $airBill->parcel_type->type ?? '' }} {{ $airBill->delivery_type->type ?? '' }}
                                                {{ $airBill->delivery_weight_charge->weight ?? '' }}
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Product Details : {{ $airBill->product_details ?? '' }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="middle" style="border-bottom:1px solid #f3732e;">

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="500" height="30" align="left" valign="middle">
                                                Merchant : {{ $airBill->user->name ?? '' }} </td>
                                            <td width="500" height="30" align="left" valign="middle">
                                                To : {{ $airBill->to_name ?? '' }} </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">
                                                Address : @if(isset($airBill->user->user_info)) {{ $airBill->user->user_info->address }} @else No @endif</td>
                                            <td height="30" align="left" valign="middle">
                                                Address : {{ $airBill->to_address }} </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">Phone :
                                                @if(isset($airBill->user->user_info)) {{ $airBill->user->user_info->phone }} @else No @endif
                                            <td height="30" align="left" valign="middle">Phone :
                                                {{ $airBill->to_number ?? '' }} </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- INVOICE 2 -->
                </td>
            </tr>
            <tr>
                <td height="30" style="border-bottom:1px dotted #000;">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <!-- INVOICE 3 -->
                    <table width="1000" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="center" valign="middle">
                                    <table width="100%" height="100" border="0" cellpadding="0" cellspacing="0"
                                        style="border-bottom:1px solid #f3732e;">
                                        <tr>
                                            <td width="350" align="left" valign="middle">
                                                <img src="{{ asset('/storage/logo.png') }}">
                                            </td>
                                            <td width="300" align="center" valign="middle"
                                                style="font-weight:bold;font-size:24px;">
                                                Customer Copy
                                            </td>
                                            <td width="350" align="center" valign="middle">
                                                <div align="right">House : {{ settings()->address }} <br>
                                                    Hotline : {{ settings()->phone }}
                                                    <br>
                                                    E-Mail : {{ settings()->email }}
                                                    <br>
                                                    Web : {{ Request::root() }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="middle">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="250" height="50" align="left" valign="middle">
                                                Booking ID : {{ $airBill->invoice_no }} </td>
                                            <td align="center" valign="middle">
                                                Booking Date : {{ $airBill->date_time }}</td>
                                            <td align="center" valign="middle">


                                                   @if ($airBill->delivery_type_id == 1)
                                                   Delivery Date : {{ Carbon\Carbon::parse($airBill->date_time)->addHour(48) }}
                                                  @elseif ($airBill->delivery_type_id == 2)
                                                   Delivery Date : {{ Carbon\Carbon::parse($airBill->date_time)->addHour(24) }}
                                                  @endif

                                            </td>
                                        </tr>

                                        {{-- <tr>
                                            <td width="250" height="50" align="left" valign="middle">

                                            </td>
                                            <td align="center" valign="middle">

                                            </td>
                                            <td align="center" valign="middle">

                                                Booking Status
                                                Return Reson

                                            </td>
                                        </tr> --}}


                                        <tr>
                                            <td height="80" align="left" valign="middle">


                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>

                                                            {!! QrCode::size(120)->generate($airBill->invoice_no); !!}
                                                        </td>
                                                        <td>
                                                            Status <br> <b> @if($airBill->status == 'pickup_pending') Pick-up Pending  @endif </b>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Total Collection Amount
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    {{ $airBill->collection_amount ?? '' }} </span>
                                            </td>


                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Area
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    {{ $airBill->hub->hub_name ?? '' }} ({{ $airBill->hub->hub_code ?? '' }}) </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="top" style="padding:5px;">
                                                Package : {{ $airBill->area_type->type ?? '' }}
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                {{ $airBill->parcel_type->type ?? '' }} {{ $airBill->delivery_type->type ?? '' }}
                                                {{ $airBill->delivery_weight_charge->weight ?? '' }}
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Product Details : {{ $airBill->product_details ?? '' }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="middle" style="border-bottom:1px solid #f3732e;">

                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="500" height="30" align="left" valign="middle">
                                                Merchant : {{ $airBill->user->name ?? '' }} </td>
                                            <td width="500" height="30" align="left" valign="middle">
                                                To : {{ $airBill->to_name ?? '' }} </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">
                                                Address : @if(isset($airBill->user->user_info)) {{ $airBill->user->user_info->address }} @else No @endif</td>
                                            <td height="30" align="left" valign="middle">
                                                Address : {{ $airBill->to_address }} </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">Phone :
                                                @if(isset($airBill->user->user_info)) {{ $airBill->user->user_info->phone }} @else No @endif
                                            <td height="30" align="left" valign="middle">Phone :
                                                {{ $airBill->to_number ?? '' }} </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- INVOICE 3 -->

                </td>
            </tr>
            <tr>
                <td height="30" style="border-bottom:1px dotted #000;">&nbsp;</td>
            </tr>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
