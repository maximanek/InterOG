@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-8 mt-5">
                <div class="col-md-12 text-center">
                    <h1>Stara funkcjonalność</h1>
                </div>
                <div class="row">
                    <div class="col-md-6  p-2">
                        <a class="btn btn-primary btn-lg btn-block" href="{{route('allegro.index')}}">Allegro</a>
                    </div>
                    <div class="col-md-6  p-2">
                        <a class="btn btn-primary btn-lg btn-block" href="{{route('shop.index')}}">Sklep</a>
                    </div>
                </div>
            </div>

            <div class="col-8">
                <div class="col-md-12 text-center">
                    <h1>Nowa funkcjonalność</h1>
                </div>
                <div class="row">
                    <a class="btn btn-primary btn-lg btn-block" href="https://allegro.pl.allegrosandbox.pl/auth/oauth/authorize?response_type=code&client_id=6a1473ac10d545dfb346aa77fcdc23a4&redirect_uri=http://localhost:8000/api/orders/">Przejdz do panelu</a>

                </div>
            </div>


        </div>
    </div>
@endsection
