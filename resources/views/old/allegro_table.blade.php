@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>
                Raport roślin ze sklepu Allegro
            </h1>
            <a href="/old/allegro" class="btn btn-primary mb-5">Dodaj kolejną liste</a>
            <form action="{{route('allegro.truncate')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary ">Wyczyść baze danych</button>
            </form>

        </div>
        @foreach($table as $seller)
        <table class="table table-hover">
            <h1 class="text-center pt-5">
                {{$seller[0]}}
            </h1>
            <thead>
            <tr>
                <th scope="col">product_name</th>
                <th scope="col">quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($seller[1] as $product)
                <tr>
                    <td>{{$product->OfferExternalId}}</td>
                    <td>{{$product->Quantity}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endforeach
        <div>
            <a href="{{route('allegro.print')}}"  class="btn btn-primary">Drukuj listy</a>
        </div>
    </div>

@endsection
