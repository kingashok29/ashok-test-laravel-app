@extends('layouts.app')
@section('title', 'Manage users')
@section('content')

  <h1>Manage users</h1>
  <p>
    Here you can manage all users and this is most important page. You can add deposit/withdrawal/
    commision to user from here.
  </p>

    <hr>

      @if($users->count() == 0)

        <div class="well no-plan">
          <h3>Sorry, but no user exist in database :( </h3>
        </div>

      @else

        <table class="table table-hover">
          <thead>
            <tr>
              <td>Name</td>
              <td>Username</td>
              <td>Email </td>
              <td>Status</td>
              <td>Actions</td>
            </tr>
          </thead>
          <tbody>

              @foreach($users as $u)
                <tr>
                  <td>{{ $u->name }}</td>
                  <td>{{ $u->username }}</td>
                  <td>{{ $u->email }}</td>
                  <td>

                    @if($u->user_role == 'admin')
                      <button type="button" class="btn btn-sm btn-danger" disabled>Block</button>
                    @else

                      @if(!$u->block)
                        <form class="form-inline" action="{{ route('user.block', $u->id) }}" method="post">
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-sm btn-danger">Block</button>
                        </form>
                      @else
                      <form class="form-inline" action="{{ route('user.unblock', $u->id) }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-sm btn-info">Unblock</button>
                      </form>
                      @endif
                    @endif

                  </td>
                  <td>
                    <a href="{{ route('admin.user-view', $u->id) }}" role="button" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.user-deposit', $u->id) }}" role="button" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i> <i class="fa fa-dollar"></i></a>
                    <a href="{{ route('admin.user-withdrawal', $u->id) }}" role="button" class="btn btn-sm btn-warning"><i class="fa fa-minus-circle"></i> <i class="fa fa-dollar"></i> </a>
                    <a href="{{ route('admin.user-commission', $u->id) }}" role="button" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> comm.</a>
                  </td>
                </tr>
              @endforeach

        </tbody>
      </table>

    @endif
@endsection
