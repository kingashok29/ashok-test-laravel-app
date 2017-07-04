@extends('layouts.app')
@section('title', 'View user')
@section('content')

  <h1>Viewing user - <u>{{ $user->name }}</u></h1>

  <div class="well well-lg view-user-well">
    <h5>
      My name is - <b><u>{{ $user->name }}</u></b>, username is - <b><u>{{ $user->username }}</u></b>. I signed up around - <b><u>{{ $user->created_at->diffForHumans() }}</u></b>,
      My important payment details are these, if they look empty means I didn't updated them yet. <br>
      PayPal Email -
      <b><u>
        @if(!$user->paypal_email)
          Not available
        @else
          {{ $user->paypal_email }}
        @endif
      </u></b>,

      Skrill Email -
      <b><u>
        @if(!$user->skrill_email)
          Not available
        @else
          {{ $user->skrill_email }}
        @endif
      </u></b>,

      Neteller Email -

      <b><u>
        @if(!$user->neteller_email)
          Not available
        @else
          {{ $user->neteller_email }}
        @endif
      </u></b>,

      Bitcoin address -
      <b><u>
        @if(!$user->bitcoin_address)
          Not available
        @else
          {{ $user->bitcoin_address }}
        @endif
      </u></b>

      <br>

      I deposited - <b><u>${{ $user->deposits()->sum('amount') }} </u></b> and I withdrawan <b><u>${{ $user->withdrawals()->sum('amount') }} </u></b>, My current
      balance is <b><u>${{ $user->deposits()->sum('amount') - $user->withdrawals()->sum('amount') }} </u></b>
      Also I earned ${{ $user->commissions()->sum('amount') }}, however I reffered <b>{{ $refs->count() }}</b> members on the site.

      <br>

      @if($refs->count())
        here is a list of user whom I reffered, you can pay me my commission.
        <ul>
          @foreach($refs as $ref)
            <li>I reffered - <b>{{ $ref->name }} ({{ $ref->username }}) </b>, around <b>{{ $ref->created_at->diffForHumans() }}</b> &amp;
               He/She deposited <b>${{ $ref->deposits()->sum('amount') }}</b>
             </li>
          @endforeach
        </ul>
      @endif

      <br>

      @if($user->commissions()->count())
      List of paid commissions -
        @foreach($user->commissions as $c)
          <li>Amount - <b>${{ $c->amount }}</b> paid around {{ $c->created_at->diffForHumans() }} as commission.</li>
        @endforeach
      @else
        No commission paid yet.
      @endif

      <hr>
      <b>Some important actions -</b> <br><br>
      <a target="_blank" href="{{ route('admin.user-deposit', $user->id) }}" role="button" class="btn btn-md btn-info"><i class="fa fa-plus-circle"></i> Deposit</a>
      <a target="_blank" href="{{ route('admin.user-withdrawal', $user->id) }}" role="button" class="btn btn-md btn-primary"><i class="fa fa-minus-circle"></i> Withdrawal </a>
      <a target="_blank" href="{{ route('admin.user-commission', $user->id) }}" role="button" class="btn btn-md btn-success"><i class="fa fa-plus-circle"></i> commission</a>
      <a href="{{ route('users.all') }}" role="button" class="btn btn-md btn-warning">View all users</a>
      </h5>
  </div>

@endsection
