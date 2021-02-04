@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 style="text-align: center">Allegro</h1>
            </div>
            <div class="col-md-8">
                <form method="POST" action="{{route('allegro.upload')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="AllegroFileInput">Wybierz Plik</label>
                        <input type="file" class="form-control" id="AllegroFileInput"  name="AllegroFileInput" placeholder="Wybierz plik">
                        <small id="allegroHelp" class="form-text text-muted">Wybierz plik CSV eksportowany ze strony Allegro</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
@endsection
