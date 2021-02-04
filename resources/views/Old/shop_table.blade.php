@extends('layouts.app')
@section('content')
<div class="container">
    <div class="text-center">
        <h1>
            Raport roślin ze sklepu
        </h1>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">product_name</th>
            <th scope="col">quantity</th>
        </tr>
        </thead>
        <tbody>
        @foreach($shop_products as $shop_product)
            <tr>
                <td>{{$shop_product->product_name}}</td>
                <td>{{$shop_product->quantity}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
