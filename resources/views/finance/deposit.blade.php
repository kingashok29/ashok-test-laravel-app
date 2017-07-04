@extends('layouts.app')
@section('title', 'Deposit money')
@section('content')

  <h1>Deposit money </h1>
  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#paymentMethod"><i class="fa fa-dollar"></i> Payment method emails</button>
  <br><br>
  <p>
    Select your plan and send money to our official payment processor email.
    Always take screen shot of payment and keep all important information.
  </p>
  <p>
    Fill the form below, enter real transaction id, payment processor, payment email, amount etc. Once you send
    we will manually verify it and after verification money will be added into your account.
  </p>

  <br>

  @if(Session::has('errors'))
    <div class="alert alert-danger form-errors">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form-horizontal" action="{{ route('deposit.save', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
      <div class="col-md-10">
        <label for="plan_id">Select Plan: ( <a href="{{ route('plans.view-all') }}">view all</a> )</label>
        <select class="form-control" name="plan_id" id="plan_id">
            <option value="">-- Select one plan --</option>
            @if(!$plans->count())
              <option value=""> -- No plans in database --</option>
            @else
              @foreach($plans as $p)
                <option class="form-control" value="{{ $p->id }}"> {{ $p->plan_name }}, amount ( {{ $p->starting_amount }} - {{ $p->ending_amount }}), duration - {{ $p->plan_duration }} days </option>
              @endforeach
            @endif
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-5">
        <label for="payment_method">Select payment method:</label>
        <select class="form-control" name="payment_method" id="payment_method">
          <option value="">-- select payment method --</option>
          <option value="paypal">PayPal</option>
          <option value="skrill">Skrill</option>
          <option value="neteller">Neteller</option>
          <option value="bitcoin">Bitcoin</option>
        </select>
      </div>

      <div class="col-md-5">
        <label for="email">Payment email:</label>
        <input type="text" name="email" id="email" class="form-control" placeholder="Enter your payment email.">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-5">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount you want to invest.">
      </div>

      <div class="col-md-5">
        <label for="transaction_id">Transaction ID:</label>
        <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="Enter transaction ID">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <label for="screenshot">Upload screenshot of payment: </label>
        <input type="file" name="screenshot" class="form-control" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <label for="remark">Any message? </label>
        <textarea name="remark" rows="4" class="form-control" placeholder="If you want to tell anything to CBI team write down here."></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <button type="submit" class="btn btn-md btn-success"> Submit my request </button>
      </div>
    </div>

  </form>

  <div id="paymentMethod" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">

        <p>Here are our payment emails. You can send your funds to given emails only.</p>
        <h5>
          @if(!$setting)
            <p class="text-center text-danger">No emails updated yet!</p>
          @else
            PayPal Email - <b>{{ $setting->paypal_email }} </b> <br>
            Skrill Email - <b>{{ $setting->skrill_email }}</b> <br>
            Neteller Email - <b>{{ $setting->neteller_email }}</b> <br>
            Bitcoin Wallet Address - <b>{{ $setting->bitcoin_address }}</b><br>
          @endif
        </h5>

        <br>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection
