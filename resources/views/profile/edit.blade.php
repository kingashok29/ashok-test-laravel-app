@extends('layouts.app')
@section('title', 'Edit your profile')
@section('content')

@if(Session::has('errors'))
  <div class="alert alert-danger form-errors">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


  <div class="panel panel-primary">
    <div class="panel-heading">
      Edit your profile - Add/Edit information!
    </div>
    <div class="panel-body">

      <form class="form-horizontal col-md-10" action="{{ route('profile.update', $user->id) }}" method="post">

        {{ csrf_field() }}

        <div class="form-group">
          <div class="col-md-6">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
          </div>

          <div class="col-md-6">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
          </div>
        </div>

        <hr>

        <div class="form-group">
          <div class="col-md-6">
            <label for="skrill_email">Skrill Email:</label>
            <input type="email" name="skrill_email" id="skrill_email" class="form-control" value="{{ $user->skrill_email }}">
          </div>

          <div class="col-md-6">
            <label for="neteller_email">Neteller Email:</label>
            <input type="email" name="neteller_email" id="neteller_email" class="form-control" value="{{ $user->neteller_email }}">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-6">
            <label for="paypal_email">PayPal Email:</label>
            <input type="email" name="paypal_email" id="paypal_email" class="form-control" value="{{ $user->paypal_email }}">
          </div>

          <div class="col-md-6">
            <label for="bitcoin_address">Bitcoin Address:</label>
            <input type="text" name="bitcoin_address" id="bitcoin_address" class="form-control" value="{{ $user->bitcoin_address }}">
          </div>
        </div>

        <br>

        <div class="form-group">
          <div class="col-md-10">
            <label for="password">Change password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your new password if you want to change else leave blank.">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-10">
            <button type="submit" class="btn btn-success btn-md">Save</button>
            <a href="{{ route('dashboard') }}" role="button" class="btn btn-md btn-danger">Cancel &amp; Go back</a>
          </div>
        </div>

      </form>

    </div>
  </div>

@endsection
