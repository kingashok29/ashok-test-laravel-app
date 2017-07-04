@extends('layouts.app')
@section('title', 'Calculate your profits')
@section('content')

  <h1>Calculate profit</h1>
  <p>
    Fill the form below and submit to see your profit results.
  </p>

  <hr>

  <form class="form-horizontal" action="{{ route('profit.result') }}" method="post">
    {{ csrf_field() }}

      <div class="form-group">
        <div class="col-md-12">
          <label for="plan">Choose plan to calculate profit:</label>
          <select class="form-control" id="plan" name="plan" required>
            <option value="">-- Choose one plan --</option>
            @foreach($plans as $p)
              <option value="{{ $p->id }}"> {{ $p->plan_name }}, {{ $p->plan_duration }} Days, {{ $p->daily_profit }}% </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-6">
          <label for="starting_date">Choose your plan starting date:</label>
          <input type="date" name="starting_date" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label for="ending_date">Choose your plan ending date:</label>
          <input type="date" name="ending_date" class="form-control" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-10">
          <label for="amount">How much you gonna invest?:</label>
          <input type="number" name="amount" class="form-control" placeholder="Enter amount without decimal points, eg: 21, 50" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-10">
          <button type="submit" class="btn btn-md btn-success"><i class="fa fa-dollar"></i> Calculate my profit</button>
          <a href="{{ route('plans.view-all') }}" role="button" class="btn btn-md btn-danger">Go back &amp; see plans</a>
        </div>
      </div>

  </form>

@endsection
