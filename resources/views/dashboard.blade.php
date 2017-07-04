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

  @if(!$plans->count())
  <!-- If user didn't subscribed any plan, show message to subscribe -->
    <div class="well no-plan text-center">
      <h3>No plan found!</h3>
      <p>Go ahead, check our plans and deposit to start earning money.</p>
    </div>
  <!-- End showing message -->
  @else
  <!-- If user subscribed any plan, show info here -->

  <h2>My plans </h2>
  <p>List of all subscribed plans with all important information.</p>

    @foreach($plans as $plan)
      <div class="well well-lg user_plan">
        <h3 class="plan__name">
          Name - {{ $plan->plan_name }}
        </h3>

        <p class="plan__info">
          Plan Information - {{ $plan->plan_info }}
        </p><br>

        <p>

          You subscribed this plan <b>{{ $plan->pivot->created_at->diffForHumans() }}</b>,
          total amount deposited by you for this plan is <b>${{ $plan->pivot->amount }}</b>,
          this plan will expire on
            <b>{{ Carbon\Carbon::parse($plan->pivot->created_at)->addDays($plan->plan_duration)->toFormattedDateString() }}</b>,
          as well you will receive total amount
            <b>${{ $plan->pivot->amount * $plan->daily_profit / 100 * $plan->plan_duration }}</b>
          back after plan expire.

        </p>

        <div class="plan__status">
          @if($plan->pivot->status == 'pending')
            <button class="btn btn-md btn-warning">Current status - Pending </button>
          @elseif($plan->pivot->status == 'expired')
            <button class="btn btn-md btn-danger">Current status - Expired </button>
          @else
            <button class="btn btn-md btn-primary">Current status - Active </button>
          @endif
        </div>

      </div>
    @endforeach
  <!-- End showing plan -->
  @endif

@endsection
