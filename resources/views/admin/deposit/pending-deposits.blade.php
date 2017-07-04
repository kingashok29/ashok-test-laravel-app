@extends('layouts.app')
@section('title', 'Pending deposi request')
@section('content')

  <h1>Pending Deposit requests</h1>
  <p>
    All requests submited by users will appear here, you can manually approve all these deposit requests after verifying submitted details by user.
    Once you view and approve request, this will appear in user's transaction history as well fund will be credited to user's account.
  </p>

  <br>

  @if(!$deposits->count())
    <div class="text-center well no-transaction">
      <h3>No deposit requests!</h3>
      <p>No one deposited any money yet.</p>
    </div>
  @else

  <table class="table table-hover">
    <thead>
      <tr>
        <td>Submitted by</td>
        <td>Amount</td>
        <td>Actions</td>
      </tr>
    </thead>
    <tbody>

        @foreach($deposits as $d)
          <tr>
            <td>{{ $d->user->name }} ( {{ $d->user->username }} )</td>
            <td>{{ $d->amount }}</td>
            <td>
              <button type="button" data-toggle="modal" data-target="#approveRequest-{{ $d->id }}" class="btn btn-sm btn-info">View &amp; approve request</button>

              <div id="approveRequest-{{ $d->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">

                      <h3>Deposit request info -</h3>
                      <p>
                        <b> {{ $d->user->name }} ( {{ $d->user->username }} ) </b> deposited <b> ${{ $d->amount }} </b>  into your
                        <i> {{ $d->payment_method }} </i>
                        account using this email - <b> {{ $d->email }}</b>, and transaction is is - <b><i>{{ $d->transaction_id }}</i></b>
                        <br>Also check screenshot below.
                      </p>

                      <img class="img img-thumbnail" width="600px" height="200px" src="{{ asset('/images/screenshots') }}/{{ $d->screenshot }}" alt="Payment screenshot">

                      <p>
                        If you believe all information mentioned above are true and you received payment, then simply click below button and
                        this amount will be added into {{ $d->user->username }}'s account, as well history record will be created.
                      </p>

                      <p>
                        Remark by user - <br>
                        <blockquote>
                          {{ $d->remark }}
                        </blockquote>
                      </p>


                      <form class="form-horizontal" action="{{ route('approve.deposit', $d->id) }}" method="post">
                        {{ csrf_field() }}
                          <button type="submit" class="btn btn-md btn-success">Approve &amp; Deposit ${{ $d->amount }} </button>
                      </form>

                      <br>

                      <form class="form-horizontal" action="{{ route('delete.deposit', $d->id) }}" method="post">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-md btn-danger">This is fake, Delete it!</button>
                      </form>


                    </div>
                  </div>
                </div>
              </div>

            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

    @endif

@endsection
