@extends('layouts.app')
@section('title', 'Add new commission')
@section('content')

<h1>Add commission into <b>{{ $user->name }}'s account.</b> </h1>
<p>Fill the form below and after submit, amount will be added into user's account as a commission.</p>

<hr>

<form class="form-horizontal" action="{{ route('admin.save-commission', $user->id) }}" method="post">
  {{ csrf_field() }}

    <div class="form-group">
      <div class="col-md-10">
        <label for="paid_for">Paying commission for which user?</label>
        <select class="form-control" name="paid_for">
          <option value="">-- Select one user, reffered by {{ $user->name }} --</option>
          @if($refs->count())
            @foreach($refs as $r)
              <option value="{{ $r->id }}">{{ $r->name }} ( {{ $r->username }} )</option>
            @endforeach
          @else
            <option value="">User reffered no one yet, so no commission.</option>
          @endif
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <input type="number" name="amount" class="form-control" placeholder="Enter amount as commission to add">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10">
        <button type="submit" class="btn btn-md btn-success">Add commission</button>
      </div>
    </div>

</form>

@endsection
