@extends('layouts.app')
@section('title', 'Welcome to Cloud Binary Invest LLC')
@section('content')

<div class="jumbotron banner">
  <div class="container">
    <hgroup>
      <h2>
        Welcome to cloud binary
      </h2>
      <h3>
        Real investment company
      </h3>
      <h5>
        You invest, we realize, you profite &amp; realize your dream with us.
      </h5>
    </hgroup>
  </div>
</div>

<p>
  Our program is intended for people willing to achieve their financial freedom but unable to
  do so because they're not financial experts. <br>

   CloudBinaryInvest is a pool programme. Money deposited from multiple investors goes to a pool.
   From pool the money goes to trading account. After the binary trading had been executed.
   The profit splitted between Trader and investors.
</p>

<br><br>

<div class="home-cto">
  <a href="{{ route('register') }}" role="button" class="btn btn-md register-btn"><i class="fa fa-user-plus"></i> Register an account</a>
  <a href="{{ route('login') }}" role="button" class="btn btn-md login-btn"><i class="fa fa-sign-in"></i> Login now</a>
</div>

@endsection
