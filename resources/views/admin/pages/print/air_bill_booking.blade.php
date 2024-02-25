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

                                                    Delivery Date : or

                                                    Return Date :
                                            </td>
                                        </tr>

                                            <tr>
                                                <td width="250" height="50" align="left" valign="middle">

                                                </td>
                                                <td align="center" valign="middle">

                                                </td>
                                                <td align="center" valign="middle">

                                                    Booking Status
                                                    Return Reson

                                                </td>
                                            </tr>


                                        <tr>
                                            <td height="80" align="left" valign="middle">


                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>

                                                            <img src="data:image/png;base64,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"
                                                                alt="barcode" style="width: 100px;" />
                                                        </td>
                                                        <td>
                                                            Status <br> <b>Booking Status </b>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Total Collection Amount
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    Booking Totoal Amount </span>
                                            </td>


                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Area
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    Booking Customer Area </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="top" style="padding:5px;">
                                                Package : Booking Destination
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Parcel Type Delivery Type
                                                Booking Weight
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Product Details : Product Details
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
                                                Merchant : Booking Marchant </td>
                                            <td width="500" height="30" align="left" valign="middle">
                                                To : Booking Customer Name </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">
                                                Address : Booking Address </td>
                                            <td height="30" align="left" valign="middle">
                                                Address : Booking Customer Address </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">Phone :
                                                Booking Phone </td>
                                            <td height="30" align="left" valign="middle">Phone :
                                                Booking Customer Phone </td>
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
                                                <div align="right">House : 01 , Kallyanpur Main Road, Dhaka , Mirpur -
                                                    1207 , Bangladesh <br>
                                                    Hotline : 01886 40 98 19
                                                    <br>
                                                    E-Mail : ecs.xyz@gmail.com
                                                    <br>
                                                    Web : www.expertcourierservice.xyz
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
                                                Booking ID : ECS-orderId </td>
                                            <td align="center" valign="middle">
                                                Booking Date : Booking Date</td>
                                            <td align="center" valign="middle">

                                                    Delivery Date :

                                                    Return Date :
                                            </td>
                                        </tr>

                                            <tr>
                                                <td width="250" height="50" align="left" valign="middle">

                                                </td>
                                                <td align="center" valign="middle">

                                                </td>
                                                <td align="center" valign="middle">

                                                    Booking Status
                                                    Return Reson

                                                </td>
                                            </tr>


                                        <tr>
                                            <td height="80" align="left" valign="middle">


                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>

                                                            <img src="data:image/png;base64,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"
                                                                alt="barcode" style="width: 100px;" />
                                                        </td>
                                                        <td>
                                                            Status <br> <b>Booking Status </b>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Total Collection Amount
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    Booking Totoal Amount </span>
                                            </td>


                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Area
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    Booking Customer Area </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="top" style="padding:5px;">
                                                Package : Booking Destination
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Parcel Type Delivery Type
                                                Booking Weight
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Product Details : Product Details
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
                                                Merchant : Booking Marchant </td>
                                            <td width="500" height="30" align="left" valign="middle">
                                                To : Booking Customer Name </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">
                                                Address : Booking Address </td>
                                            <td height="30" align="left" valign="middle">
                                                Address : Booking Customer Address </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">Phone :
                                                Booking Phone </td>
                                            <td height="30" align="left" valign="middle">Phone :
                                                Booking Customer Phone </td>
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
                                                <div align="right">House : 01 , Kallyanpur Main Road, Dhaka , Mirpur -
                                                    1207 , Bangladesh <br>
                                                    Hotline : 01886 40 98 19
                                                    <br>
                                                    E-Mail : ecs.xyz@gmail.com
                                                    <br>
                                                    Web : www.expertcourierservice.xyz
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
                                                Booking ID : ECS-orderId </td>
                                            <td align="center" valign="middle">
                                                Booking Date : Booking Date</td>
                                            <td align="center" valign="middle">

                                                    Delivery Date :

                                                    Return Date :
                                            </td>
                                        </tr>

                                            <tr>
                                                <td width="250" height="50" align="left" valign="middle">

                                                </td>
                                                <td align="center" valign="middle">

                                                </td>
                                                <td align="center" valign="middle">

                                                    Booking Status
                                                    Return Reson

                                                </td>
                                            </tr>


                                        <tr>
                                            <td height="80" align="left" valign="middle">


                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>

                                                            <img src="data:image/png;base64,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"
                                                                alt="barcode" style="width: 100px;" />
                                                        </td>
                                                        <td>
                                                            Status <br> <b>Booking Status </b>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Total Collection Amount
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    Booking Totoal Amount </span>
                                            </td>


                                            <td width="250" align="center" valign="middle"
                                                style="border:1px solid #000;padding:15px; margin:5px;">
                                                Area
                                                <br>
                                                <span style="font-weight:bold;font-size:22px;">
                                                    Booking Customer Area </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="top" style="padding:5px;">
                                                Package : Booking Destination
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Parcel Type Delivery Type
                                                Booking Weight
                                            </td>
                                            <td align="center" valign="top" style="padding:5px;">
                                                Product Details : Product Details
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
                                                Merchant : Booking Marchant </td>
                                            <td width="500" height="30" align="left" valign="middle">
                                                To : Booking Customer Name </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">
                                                Address : Booking Address </td>
                                            <td height="30" align="left" valign="middle">
                                                Address : Booking Customer Address </td>
                                        </tr>
                                        <tr>
                                            <td height="30" align="left" valign="middle">Phone :
                                                Booking Phone </td>
                                            <td height="30" align="left" valign="middle">Phone :
                                                Booking Customer Phone </td>
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
