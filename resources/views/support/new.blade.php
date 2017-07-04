@extends('layouts.app')
@section('title', 'Contact support')
@section('content')

  <h1>Contact support</h1>
  <p>Fill the form below and submit, we will reply back to you via email as soon as possible.</p>

  <form class="form-horizontal" action="{{ route('support.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <div class="col-md-5">
        <label for="name">Your Name:</label>
          @if(Auth::check())
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
          @else
            <input type="text" class="form-control" name="name" value="" placeholder="Enter your name">
          @endif
      </div>

      <div class="col-md-5">
        <label for="email">Your email:</label>
          @if(Auth::check())
            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
          @else
            <input type="email" class="form-control" name="email" value="" placeholder="Enter your email address">
          @endif
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <label for="message">Your message:</label>
        <textarea name="message" class="form-control" rows="6" placeholder="Please write in detail about your query, you can include links, link of images etc.."></textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <button type="submit" class="btn btn-md btn-success"><i class="fa fa-send"></i> Send my query</button>
        <button type="reset" class="btn btn-md btn-danger"><i class="fa fa-eraser"></i> Reset message</button>
      </div>
    </div>

  </form>

@endsection
