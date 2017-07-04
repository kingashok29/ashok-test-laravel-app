@extends('layouts.app')
@section('title', 'Pending withdrawal requests')
@section('content')

  <h1> Pending withdrawal requests. </h1>

  <p>
    All withdrawal requests submitted by users will appear here, you can check the details if everything is fine. After sending fund to user's given
    details in request, just add the transaction ID and save, after that request will appear in user's transaction history as well funds will be
    debited from account.
  </p>

  <br>

  @if(!$withdrawals->count())
    <div class="text-center well no-transaction">
      <h3>No withdrawal requests!</h3>
      <p>No one withdrawan money yet.</p>
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

        @foreach($withdrawals as $w)
          <tr>
            <td>{{ $w->user->name }} ( {{ $w->user->username }} )</td>
            <td>{{ $w->amount }}</td>
            <td>

              <button type="button" data-toggle="modal" data-target="#approveWithdraw-{{ $w->id }}" class="btn btn-sm btn-info">Send money &amp; approve</button>

              <div id="approveWithdraw-{{ $w->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">

                      <h3>Withdrawal Request Info -</h3>
                      <p>
                        <b> {{ $w->user->name }} ( {{ $w->user->username }} ) </b> requested <b> ${{ $w->amount }} </b>  to be sent via
                        <i> {{ $w->payment_method }} </i>
                        on his email - <b> {{ $w->email }}</b>
                      </p>

                      <p>Message from user - <br>
                        {{ $w->message }}
                      </p>

                      <p>
                        So you have to send funds to above mentioned details and after done just enter the transaction ID and hit
                        withdraw fund button at bottom to complete request. After you complete request fund will be deduced from user account
                        and one record will be inserted into {{ $w->user->username }}'s account.
                      </p>


                      <form class="form-horizontal" action="{{ route('approve.withdraw', $w->id) }}" method="post">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <div class="col-md-6">
                              <input type="text" name="transaction_id" class="form-control" placeholder="REQUIRED Enter the transaction ID." rquired>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-md btn-success">Withdraw ${{ $w->amount }} &amp; Approve</button>
                      </form>

                      <br>

                      <form class="form-horizontal" action="{{ route('delete.withdraw', $w->id) }}" method="post">
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
