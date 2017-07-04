@extends('layouts.app')
@section('title', 'Welcome to admin panel')
@section('content')

    <h1>Welcome to admin panel</h1>
    <p>
      Click on left menu and manage this website.
    </p>
    <ul>
      <li> Click on users to Edit/Delete/Block any user.</li>
      <li> You can also make any user ADMIN so they can help to manage site.</li>
      <li>
        Click on DEPOSITS to approve any deposit which user send. Once you approve everything like
        adding deposit record to user, adding deposit amount to overall amount on site.
        Same process for withdrawals.
      </li>
      <li>
        Click on support questies and you will see all requests send by users. You can directly
        reply from here to their email address.
      </li>
      <li>
        Click on FAQs to add new FAQ on site.
      </li>
      <li>
        Click on PLANS to add/edit investment plans.
      </li>

    </ul>

      <p> Enjoy managing Cloud Binary Invest LLC. </p>

@endsection
