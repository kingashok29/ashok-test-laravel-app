@extends('layouts.app')
@section('title', 'All support queries.')
@section('content')

  <h1>Support queries </h1>

  <p>You can view indivisual query, to reply any query click on SEND icon, fill the form and send. Your answer of query will be sent to user.</p>

  <form class="form-horizontal" action="{{ route('query.delete') }}" method="post">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-md btn-danger"><i class="fa fa-trash"></i> Delete all replied queries</button>
  </form>

  <hr>

  @if($queries->count() == 0)

    <div class="well no-plan">
      <h3>No support queries received yet! </h3>
    </div>

  @else

    <table class="table table-hover">
      <thead>
        <tr>
          <td>Name</td>
          <td>Message</td>
          <td>Actions</td>
        </tr>
      </thead>
      <tbody>

          @foreach($queries as $q)
            <tr>
              <td>{{ $q->name }}</td>
              <td>{{ str_limit($q->message, 50) }}</td>
              <td>
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#viewQuery-{{ $q->id }}"><i class="fa fa-eye"></i></button>

                  <div id="viewQuery-{{ $q->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">

                          <div class="query-container">
                            <h4>
                              <strong>{{ $q->name }}</strong> said, on
                               ( {{ $q->created_at->toDayDateTimeString() }} )
                            </h4>
                            <p>
                              {{ $q->message }}
                            </p>

                            <span class="help-block">{{ $q->email }}</span>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <a href="{{ route('query.reply', $q->id) }}" role="button" class="btn btn-sm btn-success"><i class="fa fa-reply"></i></a>

              </td>
            </tr>
          @endforeach

    </tbody>
  </table>

@endif

@endsection
