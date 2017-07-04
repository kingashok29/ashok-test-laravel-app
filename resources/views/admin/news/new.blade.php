@extends('layouts.app')
@section('title', 'Add new news')
@section('content')

  <h1>Add new news</h1>
  <p>Fill the form below and submit.</p>

  <hr>

  <form class="form-horizontal" action="{{ route('news.store') }}" method="post">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="col-md-10">
        <input type="text" name="news_title" class="form-control" placeholder="Enter the title of news">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <textarea name="news_body" rows="4" class="form-control" placeholder="Enter the news body"></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <button type="submit" class="btn btn-md btn-success">Add news</button>
      </div>
    </div>

  </form>

@endsection
