@extends('layouts.app')
@section('title', 'Transaction history')
@section('content')

  <h1>Your transaction history </h1>
  <p>
    Here you can check your deposit and withdrawal history with important information like amount,
    payment method, payment email, transaction id, status etc.
  </p>


  @if(!$deposits->count())
    <div class="well no-transaction text-center">
      <h3>You did't made any deposit yet.</h3>
      <p>Go ahead, choose a plan and invest some money.</p>
    </div>
  @else

  <h3>Deposit History -</h3>

    <table class="table table-hover transaction-table">
      <thead>
        <tr>
          <td>Amount</td>
          <td>Method</td>
          <td>Email</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        @foreach($deposits as $d)
          <tr>
            <td>{{ $d->amount }}</td>
            <td>{{ $d->payment_method }}</td>
            <td>{{ $d->email }}</td>
            <td>
              @if($d->status)
                <button type="button" class="btn btn-sm btn-success" rel="tooltip" title="Request completed!"><i class="fa fa-check"></i></button>
              @else
                <button type="button" class="btn btn-sm btn-danger" rel="tooltip" title="Request NOT completed!"><i class="fa fa-close"></i></button>
              @endif
            </td>
            <td>
              <a target="_blank" href="{{ route('view.transaction', ['Deposit', $d->id] ) }}" role="button" class="btn btn-sm btn-info"><i class="fa fa-eye"> </i> view</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

@endif


@if(!$withdrawals->count())
  <div class="well no-transaction text-center">
    <h3>You did't requested money yet.</h3>
    <p>May be your plan is not expired yet or you didn't purchased any plan yet.</p>
  </div>
@else


    <h3>Withdrawal History -</h3>

      <table class="table table-hover transaction-table">
        <thead>
          <tr>
            <td>Amount</td>
            <td>Method</td>
            <td>Email</td>
            <td>Status</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($withdrawals as $w)
            <tr>
              <td>{{ $w->amount }}</td>
              <td>{{ $w->payment_method }}</td>
              <td>{{ $w->email }}</td>
              <td>
                @if($w->status)
                  <button type="button" class="btn btn-sm btn-success" rel="tooltip" title="Request completed!"><i class="fa fa-check"></i></button>
                @else
                  <button type="button" class="btn btn-sm btn-danger" rel="tooltip" title="Request NOT completed!"><i class="fa fa-close"></i></button>
                @endif
              </td>
              <td>
                <a target="_blank" href="{{ route('view.transaction', ['Withdrawal', $d->id] ) }}" role="button" class="btn btn-sm btn-info"><i class="fa fa-eye"> </i> view</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

@endif

@endsection
