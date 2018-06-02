@extends('layouts.master')

@section('title')
Shopping Cart
@endsection


@section('content')
@if(Session::has('cart'))
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        <span class="badge">{{ $product['qty'] }}</span>
                        <strong>{{ $product['item']['title'] }}</strong>
                        <span class="label label-success">{{ $product['price'] }}</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('shop.reduce',['id' => $product['item']['id']]) }}">Reduce by 1</a></li>
                                <li><a href="{{ route('shop.remove',['id' => $product['item']['id']]) }}">Reduce All</a></li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <strong>Total: {{ $totalPrice }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <a type="button" href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>No Items in Cart!</h2>
        </div>
    </div>
@endif
@endsection