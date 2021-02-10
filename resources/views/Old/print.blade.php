<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>InterOG</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        table{
            border: 5px solid #000000;
        }

        th, td {
            border: 1px solid #000000;
        }
    </style>
    <script>
        print();
    </script>
</head>
<body>

    <div class="">
        @foreach($orders as $order)

            <table class="" style="page-break-inside:avoid; margin : 30px; width: 1000px" >
                <tr>
                    <td colspan="4">
                        <b>Kupujący:</b> {{$order->BuyerId}} - {{$order->BuyerName}} <b>Adresat: </b> {{$order->DeliveryAddressName}} {{$order->DeliveryAddressStreet}} {{$order->DeliveryAddressCity}};
                    </td>

                </tr>
                <tr>
                    <th></th>
                    <th colspan="3">Data zamówienia: {{$order->OrderDate}}</th>
                </tr>
                <tr>
                    <th>Nazwa przedmiotu</th>
                    <th>Sztuk</th>
                    <th>Sygnatura</th>
                    <th>Cena</th>
                </tr>
                @foreach($order->products as $product)
                    <tr>
                        <td>{{$product->Name}}</td>
                        <td>{{$product->Quantity}}</td>
                        <td>{{$product->OfferExternalId}}</td>
                        <td>{{$product->Price}} {{$product->Currency}}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3">Suma do zapłaty:</th>
                    <td>{{$order->TotalPaidAmount}}{{$order->TotalPaidCurrency}}</td>
                </tr>
                <tr>
                    <td colspan="4">Wiadomość od kupującego: {{$order->BuyerNotes}}</td>
                </tr>
                <tr>
                    <td colspan="4">Twoja notatka: {{$order->SellerNotes}}</td>
                </tr>
            </table>
        @endforeach
    </div>

</body>
</html>





