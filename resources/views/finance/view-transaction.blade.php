@extends('layouts.app')
@section('title', 'View transaction')
@section('content')


  <div class="well well-lg no-transaction">
    <h5>Transaction info:</h5>
    <p>
      Transaction type - <b>{{ $type }}</b> <br>
      Transaction ID - <b>{{ $t->transaction_id }}</b> <br>
      Amount - <b>${{ $t->amount }}</b> <br>
      Payment method - <b>{{ $t->payment_method }}</b> <br>
      Payment email - <b>{{ $t->email }}</b><br>
      <b>
        @if($t->status == true)
          Completed
        @else
          Not completed
        @endif
      </b>
      <br>
      Message -
      <b>
        @if($type == 'Deposit')
          @if($t->remark)
            {{ $t->remark }}
          @else
            No remark!
          @endif
        @else
          @if($t->message)
            {{ $t->message }}
          @else
            No message!
          @endif
        @endif
      </b>
    </p>

    <a href="{{ route('history.all') }}" role="button" class="btn btn-sm btn-danger"><i class="fa fa-chevron-circle-left "></i> Go back</a>
    <button class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print transaction</button>

  </div>

@endsection
