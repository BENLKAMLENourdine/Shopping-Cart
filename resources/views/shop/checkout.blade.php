@extends('layouts.master')

@section('title')
Checkout
@endsection


@section('content')
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <h1>Checkout</h1>
    <div class="alert alert-danger {{ Session::has('error') ? '' : 'hidden' }}" id="payment-errors" >
      {{ Session::get('error') }}
    </div>
    <h4>Your total is: {{ $total }}</h4>
    <form action="{{ route('checkout') }}" method="post" id="checkout-form">
      <div class="row">
        <div class="col-xs-12">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="card-name">Card Holder Name</label>
            <input type="text" name="card-name" id="card-name" class="form-control" required>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="card-number">Credit Card Number</label>
            <input type="text" name="card-number" id="card-number" class="form-control" required>
          </div>
        </div>
        <div class="col-xs-12">
        <div class="row">
          <div class="col-xs-6">
          <div class="form-group">
            <label for="card-expiry-year">Expiration Year</label>
            <input type="text" name="card-expiry-year" id="card-expiry-year" class="form-control" required>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="form-group">
            <label for="card-expiry-month">Expiration Month</label>
            <input type="text" name="card-expiry-month" id="card-expiry-month" class="form-control" required>
          </div>
        </div>
        </div>
        </div>
        <div class="col-xs-12">
          <div class="form-group">
            <label for="cvc">CVC</label>
            <input type="text" name="cvc" id="cvc" class="form-control" required>
          </div>
        </div>
      </div>
      {{csrf_field()}}
      <button type="submit" class="btn btn-success">Buy Now</button>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="{{ URL::to('js/checkout.js') }}"></script>
@endsection