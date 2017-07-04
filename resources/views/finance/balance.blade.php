@extends('layouts.app')
@section('title', 'My balance')
@section('content')

  <h1>My balance</h1>
  <p>
    Here you can check your current balance, as well total amount you deposited, you earned as commission and
    total amount you withdrawn back into your e-wallet accounts.
  </p>

  <div class="well no-transaction text-center">
    <h3>Available balance &bull; <b> ${{ $balance + Auth::user()->commissions()->sum('amount') }} </b> </h3>
  </div>

  <hr>

  <table class="table table-hover">
      <tbody>
          <tr>
            <th>Total Deposit</th>
            	<td>${{ $deposit }}</td>
          </tr>
          <tr>
            <th>Total withdrawal</th>
              <td>${{ $withdrawal }}</td>
          </tr>
        <tr>
            <th>Total commission</th>
              <td>${{ Auth::user()->commissions()->sum('amount') }}</td>
          </tr>

      </tbody>
  </table>

@endsection
