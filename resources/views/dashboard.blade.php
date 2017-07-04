@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')


  <!-- Showing user info, basic and payment info -->

  <div class="panel panel-default">
    <div class="panel-heading">
      Welcome back, <b>{{ $user->name }}</b>
    </div>
    <div class="panel-body profile-container">

      <div class="left">
        <img src="{{ $profile_pic }}" alt="Profile picture of {{ $user->name }}" width="100px" height="100px" class="img-thumbnail img-circle">
      </div>

      <div class="middle">
        <h4>Basic Info:</h4>
        <p>
          <b> Name </b> - {{ $user->name }} <br>
          <b> Username </b> - {{ $user->username }} <br>
          <b> Email </b> - {{ $user->username }} <br>
          <b> Joined </b> - {{ $user->created_at->diffForHumans() }} <br>
          @if($user->last_logged_in)
            <b>Last logged in</b> - {{ $user->last_logged_in->diffForHumans() }} <br>
          @endif
        </p>
      </div>

      <div class="right">
        <h4>Payment Info:</h4>
        <p>
          <b>PayPal email </b> -
          @if(!$user->paypal_email)
              Not available!
            @else
              {{ $user->paypal_email }}
            @endif <br>

          <b>Skrill email </b> -

          @if(!$user->skrill_email)
            Not available!
          @else
            {{ $user->skrill_email }}
          @endif <br>

          <b>Neteller email </b> -

          @if(!$user->neteller_email)
            Not available!
          @else
            {{ $user->neteller_email }}
          @endif <br>

          <b>Bitcoin email </b> -

          @if(!$user->bitcoin_address)
            Not available!
          @else
            {{ $user->bitcoin_address }}
          @endif <br>

        </p>
      </div>

    </div>
  </div>

  <!-- If user purchased any plan -->

    <div class="well well-plan">
      <h3> Earn 10% daily </h3>
      <h5> Earn 10% daily for 10 days. </h5>
      <p>You purchased this plan on 25th June 2017 and this plan will expire on 25th July 2017.</p>

        <div class="user-plan-details">
          <li>Investment - $250</li>
          <li>Total profit - 150% ($350)</li>
        </div>
    </div>

  <!-- End showing user plans -->

    <div class="no-plan well text-center">
      <h3>Sorry but it looks like you didn't purchased any plan yet :( </h3>
      <p>Go ahead and see our awesome <a href="#">plans</a> thanks!</p>
    </div>

  <!-- If user didn't purchased any plan yet -->

  <!-- End message to purchase -->

@endsection
