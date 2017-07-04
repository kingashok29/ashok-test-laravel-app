@extends('layouts.app')
@section('title', 'Create new plan')
@section('content')

  <h1>Create a new plan</h1>
  <p>Fill the form below with all required information to create a new plan for investers.</p>

  @if(Session::has('errors'))
    <div class="alert alert-danger form-errors">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form-horizontal" action="{{ route('plan.save') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="col-md-4">
        <label for="plan_name">Plan name:</label>
        <input type="text" name="plan_name" class="form-control" placeholder="Enter the plan name.">
      </div>
      <div class="col-md-4">
        <label for="plan_duration">Plan duration:</label>
        <input type="number" name="plan_duration" class="form-control" placeholder="Enter the plan duration in days.">
      </div>
      <div class="col-md-4">
        <label for="plan_profit">Daily profit (%):</label>
        <input type="number" name="daily_profit" class="form-control" placeholder="Enter the plan profit.">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <label for="plan_info">Plan information:</label>
        <textarea name="plan_info" rows="4" class="form-control" placeholder="Write all important info about plan."></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-6">
        <label for="starting_amount">Starting amount:</label>
        <input type="number" name="starting_amount" class="form-control" placeholder="Enter the plan starting amount.">
      </div>
      <div class="col-md-6">
        <label for="ending_amount">Ending amount:</label>
        <input type="number" name="ending_amount" class="form-control" placeholder="Enter the plan ending amount.">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="btn btn-md btn-primary"><i class="fa fa-plus-circle"></i> Add new investment plan</button>
      </div>
    </div>

  </form>

@endsection
