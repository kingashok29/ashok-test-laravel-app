@extends('layouts.app')
@section('title', 'Add new deposit')
@section('content')

  <h1>Add deposit to <b>{{ $user->name }}'s account.</b> </h1>
  <p>Fill the form below and after submit, amount will be added into user's account.</p>

  <form class="form-horizontal" action="{{ route('admin.user-save-deposit', $user->id) }}" method="post">
    {{ csrf_field() }}

      <div class="form-group">
        <div class="col-md-6">
          <input type="text" name="transaction_id" class="form-control" placeholder="Enter transaction ID">
        </div>
        <div class="col-md-6">
          <input type="text" name="payment_method" class="form-control" placeholder="Enter the name of payment method">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-6">
          <input type="number" name="amount" class="form-control" placeholder="Enter amount">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" name="email" placeholder="Enter payment email on which you sent payment">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-10">
          <button type="submit" class="btn btn-md btn-success">Add deposit</button>
        </div>
      </div>

  </form>

@endsection
