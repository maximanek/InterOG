@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>
                Raport roślin ze sklepu
            </h1>
            <a href="/old/allegro" class="btn btn-primary mb-5">Dodaj kolejną liste</a>
            <form action="{{route('allegro.truncate')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary ">Wyczyść baze danych</button>
            </form>

        </div>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Marcin
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Marcin as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Wiesiek
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Wiesiek as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Michał
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Michal as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Pani Tomaka
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($PaniTomaka as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Paszczyna
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Paszczyna as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Zbigniew
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Zbigniew as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Andrzej
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Andrzej as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Elgarden
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Elgarden as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Mirochna
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Mirochna as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                Typer
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($Typer as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <a href="{{route('allegro.print')}}"  class="btn btn-primary">Drukuj listy</a>
        </div>
    </div>




@endsection
