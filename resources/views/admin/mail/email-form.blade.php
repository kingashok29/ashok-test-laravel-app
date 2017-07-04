@extends('layouts.app')
@section('title', 'Send New Email To User')
@section('content')

  <h1>Send email to users</h1>
  <p>
    Choose user, write message and hit submit button. System will
    find email address of your choosen user and will send him/her an email containing your message.
  </p>

  <form class="form-horizontal" action="{{ route('send.email') }}" method="post">
    {{ csrf_field() }}

      <div class="form-group">
        <div class="col-md-10">
          <select class="form-control" name="user_id">
            <option value="">-- Select one user --</option>
            @foreach($users as $u)
              <option value="{{ $u->id }}"> {{ $u->name }} ( {{ $u->username }} ) </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-10">
          <textarea name="message" rows="6" class="form-control" placeholder="Enter message you want to send to the choosen user..."></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-10">
          <button type="submit" class="btn btn-md btn-success"><i class="fa fa-send"> </i> Send email </button>
        </div>
      </div>

  </form>

@endsection
