@extends('layouts.app')
@section('title', 'Refer a friend')
@section('content')

  <h1>Refer a friend</h1>
  <p>
    As you know "Cloud Binary Invest LLC" is an invite based investment company, means you can refer your friend
    on behalf of your experience. To refer your friend just tell them to enter your username on signup
    form's "Who reffered you?" field. Your username is - <b>{{ Auth::user()->username }}</b>
  </p>

  <div class="ref-container">
    <div class="total-refer text-center well">
      <h3>Total refferals</h3>
      <span class="number"> {{ $refs->count() }} </span>
    </div>
    <div class="total-commision text-center well">
      <h3>Total commision</h3>
      <span class="number"> ${{ $ref_amount }} </span>
    </div>
  </div>


  @if(!$refs->count())

    <div class="well no-transaction text-center">
      <h3>Nothing to show here!</h3>
      <p>Refer some friend to see their details below.</p>
    </div>

  @else
  <table class="table table-hover">
    <thead>
      <tr>
        <td>Name</td>
        <td>Username</td>
        <td>Signed up</td>
      </tr>
    </thead>
    <tbody>
      @foreach($refs as $r)
        <tr>
          <td>{{ $r->name }}</td>
          <td>{{ $r->username }}</td>
          <td>{{ $r->created_at->diffForHumans() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @endif


@endsection
