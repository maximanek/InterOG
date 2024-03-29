@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: center">
                    <a href="/" class="btn btn-primary mb-5 float-left">Wróć</a>
                    Sklep
                </h1>
            </div>
            <div class="col-md-8">
                <form method="POST" action="{{route('shop.upload')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="InputFile">Wybierz Plik</label>
                        <input type="file" class="form-control" id="ShopFileInput" name="ShopFileInput" placeholder="Wybierz plik">
                        <small id="shopHelp" class="form-text text-muted">Wybierz plik CSV eksportowany ze strony internetowyogrod.pl</small>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>

        </div>
    </div>



@endsection
