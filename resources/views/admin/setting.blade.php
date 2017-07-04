@extends('layouts.app')
@section('title', 'Admin setting')
@section('content')

  <h1>Admin settings</h1>
  <p>Add payment processor emails below. Your given emails will appear on user's deposit page.</p>

  @if(!$setting)

        <form class="form-horizontal" action="{{ route('save.admin-setting') }}" method="post">
          {{ csrf_field() }}

          <div class="form-group">
            <div class="col-md-6">
              <label for="paypal_email">PayPal Email:</label>
              <input type="email" id="paypal_email" class="form-control" name="paypal_email" value="{{ old('paypal_email') }}">
            </div>

            <div class="col-md-6">
              <label for="skrill_email">Skrill Email:</label>
              <input type="email" id="skrill_email" class="form-control" name="skrill_email" value="{{ old('skrill_email') }}">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6">
              <label for="neteller_email">Neteller Email:</label>
              <input type="email" id="neteller_email" class="form-control" name="neteller_email" value="{{ old('neteller_email')}}">
            </div>

            <div class="col-md-6">
              <label for="bitcoin_address">Bitcoin Address:</label>
              <input type="text" id="bitcoin_address" class="form-control" name="bitcoin_address" value="{{ old('bitcoin_address') }}">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-10">
              <button type="submit" class="btn btn-md btn-success">Save details</button>
            </div>
          </div>

        </form>

    @else


    <form class="form-horizontal" action="{{ route('update.admin-setting', $setting->id) }}" method="post">
      {{ csrf_field() }}

      <div class="form-group">
        <div class="col-md-6">
          <label for="paypal_email">PayPal Email:</label>
          <input type="email" id="paypal_email" class="form-control" name="paypal_email" value="{{ $setting->paypal_email }}">
        </div>

        <div class="col-md-6">
          <label for="skrill_email">Skrill Email:</label>
          <input type="email" id="skrill_email" class="form-control" name="skrill_email" value="{{ $setting->skrill_email }}">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-6">
          <label for="neteller_email">Neteller Email:</label>
          <input type="email" id="neteller_email" class="form-control" name="neteller_email" value="{{ $setting->neteller_email }}">
        </div>

        <div class="col-md-6">
          <label for="bitcoin_address">Bitcoin Address:</label>
          <input type="text" id="bitcoin_address" class="form-control" name="bitcoin_address" value="{{ $setting->bitcoin_address }}">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-10">
          <button type="submit" class="btn btn-md btn-success">Update payment details</button>
        </div>
      </div>

    </form>


    @endif

@endsection
