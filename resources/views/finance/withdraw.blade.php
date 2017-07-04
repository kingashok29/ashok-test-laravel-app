@extends('layouts.app')
@section('title', 'Withdraw money')
@section('content')

  <h1>Withdraw money </h1>
  <p>
    Your current balance is visible on left side. Fill the form below to request your money. Remember you
    can not request your money untill your current purchased plan is not expired.
  </p>

  <br>

  <form class="form-horizontal" action="{{ route('withdraw.save', Auth::user()->id) }}" method="post">
    {{ csrf_field() }}

      <div class="form-group">
        <div class="col-md-4">
          <label for="amount">Amount:</label>
          <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount you want to withdraw.">
        </div>

        <div class="col-md-4">
          <label for="payment_method">Payment method:</label>
            <select class="form-control" name="payment_method" name="payment_method">
              <option value="">-- select payment method --</option>
              <option value="paypal">PayPal</option>
              <option value="skrill">Skrill</option>
              <option value="neteller">Neteller</option>
              <option value="bitcoin">Bitcoin</option>
          </select>
        </div>

        <div class="col-md-4">
          <label for="email"> Payment email: </label>
          <input type="text" id="email" name="email" class="form-control" placeholder="Enter payment email.">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label for="remark">Any message?</label>
          <textarea name="remark" rows="4" class="form-control" placeholder="Any message regarding this withdrawal request to CBI team."></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <button type="submit" class="btn btn-md btn-success"></i> Withdraw money </button>
        </div>
      </div>

  </form>

@endsection
