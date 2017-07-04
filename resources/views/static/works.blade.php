@extends('layouts.app')
@section('title', 'How it wokrs')
@section('content')

  <h1>How our website works</h1>

  <p>
    Here is a complete step by step guide to understand the website, please read every step written
    on this page in order to understand the website.
  </p>

  <div class="work-main-container">
    <div class="single-container">
      <h3>Signup for an account.</h3>
      <p>
        You must have an account on our website in order to participate in investment plans,
        so if you don't have any account, go ahead and <a href="{{ url('/register') }}">
          register an account </a>
      </p>
    </div>

    <div class="single-container">
      <h3>Login into account.</h3>
      <p>
        After registering an account, go ahead and <a href="{{ url('/register') }}">
          login into your account </a> once you logged in, you can see your profile and
          all member protected informations.
      </p>
    </div>

    <div class="single-container">
      <h3>Read all FAQs and Rules.</h3>
      <p>
        Before making any investment on our website, we highly suggest you to read all of our
        FAQs and Rules available on our website.
      </p>
    </div>

    <div class="single-container">
      <h3>Check investment plans.</h3>
      <p>
        Now take a loot at our investment plans and study them. You can check the plan amount
        plan duration, return on your investment etc, select your prefered plan and go ahead.
      </p>
    </div>

    <div class="single-container">
      <h3>Deposit money.</h3>
      <p>
        All payment on website are manual means you have to send payment to our company e-wallet
        account, after sending payment, you also have to fill a form by filling all important info
        like transaction id, payment method, amount, screenshot &amp; plan info. Once we verify
        transaction, the money will be credited into your account.
      </p>
    </div>

    <div class="single-container">
      <h3>Withdraw money.</h3>
      <p>
        You can request your money back with profit, once your plan duration end by filling and
        sending form on website. We will send money to your original payment processor back and
        after transaction money will be debited from your website account.
      </p>
    </div>

  </div>

@endsection
