@extends('layouts.app')
@section('title', 'Reply to query.')
@section('content')

  <h1>Query reply </h1>

  <div class="well well-lg">
    <p>
      {{ $query->name }} said, <br>
      {{ $query->message }}
    </p>
  </div>


  <form class="form-horizontal" action="{{ route('query.send-reply', $query->id) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <div class="col-md-10">
        <label for="reply_body">Reply message:</label>
        <textarea name="reply_body" class="form-control" rows="6" placeholder="Enter your reply which you want to send to the email of query sender."></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-send"></i> Send email &amp; Mark as replied </button>
        <a href="{{ route('support.queries') }}" role="button" class="btn btn-md btn-warning">View all queries</a>
      </div>
    </div>

  </form>

@endsection
