  <div class="sidebar">

    @if(Auth::check())
    <!-- If user is logged in -->

      <div class="user-menu panel panel-success">
        <div class="panel-heading"> Menu </div>
          <div class="panel-body site-menu">
            <ul>

                @if(Auth::user()->checkIfAdmin())
                  <li><i class="fa fa-user"></i> <a href="{{ route('users.all') }}"> Users </a> </li>
                  <li><i class="fa fa-plus-circle"></i> <a href="{{ route('pending.deposits') }}"> Deposits </a> </li>
                  <li><i class="fa fa-minus-circle"></i> <a href="{{ route('pending.withdrawals') }}"> Withdrawals </a> </li>
                  <li><i class="fa fa-list-alt"></i> <a href="{{ route('plans.all') }}"> Plans </a> </li>
                  <li><i class="fa fa-question-circle-o"></i> <a href="{{ route('faqs.all') }}"> FAQs </a> </li>
                  <li><i class="fa fa-support"></i> <a href="{{ route('support.queries') }}"> Support Queries </a> </li>
                  <li><i class="fa fa-gear"></i> <a href="{{ route('admin.setting') }}">Site settings</a> </li>

                  <li><i class="fa fa-newspaper-o"></i> <a href="{{ route('news.all') }}">News Feed</a> </li>
                  <li><i class="fa fa-mail-reply-all"></i> <a href="{{ route('email.form') }}">Send Emails</a> </li>
                @else
                  <li><i class="fa fa-user"></i> <a href="{{ route('dashboard') }}"> Dashboard </a> </li>
                  <li><i class="fa fa-edit"></i> <a href="{{ route('profile.edit', Auth::user()->id ) }}"> Edit Profile </a> </li>
                  <li><i class="fa fa-plus-circle"></i> <a href="{{ route('deposit.new', Auth::user()->id ) }}"> Deposit </a> </li>
                  <li><i class="fa fa-minus-circle"></i> <a href="{{ route('withdraw.new', Auth::user()->id ) }}"> Withdrawal </a> </li>
                  <li><i class="fa fa-dollar"></i> <a href="{{ route('my.balance') }}"> My balance </a></li>
                  <li><i class="fa fa-history"></i> <a href="{{ route('history.all') }}"> History </a> </li>
                  <li><i class="fa fa-chain"></i> <a href="{{ route('ref.all') }}">Referal setting</a></li>
                @endif

              <br>
              <li>
                  <a role="button" class="btn btn-block btn-md btn-danger" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out"></i> Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>

            </ul>
          </div>
       </div>


       @if (Auth::user()->checkIfAdmin())
         <div class="admin-container text-center">
           <h3><i class="fa fa-id-card-o"></i>
             <a href="{{ route('admin.dashboard') }}"> Admin Panel </a>
           </h3>
         </div>
        @endif
      @endif
    <!-- If user is not logged in -->

    @if(!Auth::check())

      <div class="site-info-panel panel panel-default">
        <div class="panel-heading">
          Site info
        </div>
        <div class="panel-body site-list-item">

            <table class="custom-table" width="100%">
              <tbody>
                <tr>
                  <td>Started on</td>
                  <td><b>{{ $startDate }}</b></td>
                </tr>
                <tr>
                  <td>Running days </td>
                  <td><b>{{ $days }} Days</b></td>
                </tr>
                <tr>
                  <td>Total accounts</td>
                  <td><b>{{ $totalAccounts }}</b></td>
                </tr>
                <tr>
                  <td>Active accounts</td>
                  <td><b>{{ $activeAccounts }}</b></td>
                </tr>
                <tr>
                  <td>Total deposits</td>
                  <td><b>${{ $totalDeposits }}</b></td>
                </tr>
                <tr>
                  <td>Total withdrawal</td>
                  <td><b>${{ $totalWithdrawals }}</b></td>
                </tr>
              </tbody>
            </table>

        </div>
      </div>

      <div class="well news-container">
        @if($news)
          <h3>Latest news:</h3>
          <h5> {{ $news->news_title }} </h5>
          <p> {{ str_limit($news->news_body, 30) }} </p>
          <button class="btn btn-sm btn-block btn-info" data-toggle="modal" data-target="#newsModal">Read more</button>

          <div id="newsModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <div class="modal-content">
                  <div class="modal-body">
                    <h5> {{ $news->news_title }} </h5>
                    <p>
                      {{ $news->news_body }}
                    </p>
                    <p class="time"> Posted around {{ $news->created_at->diffForHumans() }} </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

        @else
          <div class="no-news">
            <h3>No news found</h3>
            <p>Announcement and news will appear here.</p>
          </div>
        @endif
      </div>

      @endif

      @if(Auth::check() && !Auth::user()->checkIfAdmin())

      <div class="help-container text-center">
        <h3>
          <a href="{{ route('support.new') }}"><i class="fa fa-support"></i> Need help</a>
        </h3>
      </div>

      @endif

      <div class="payment-container text-center">
        <h3>Payment methods</h3>
        <br>
        <img class="img" src="{{ asset('images/paypal.png') }}" width="auto" height="55px"  alt="PayPal Logo">
        <img class="img" src="{{ asset('images/skrill.png') }}" width="auto" height="55px" alt="Skrill Logo">
        <img class="img" src="{{ asset('images/neteller.png') }}" width="auto" height="55px" alt="Neteller Logo">
        <img class="img" src="{{ asset('images/bitcoin.png') }}" width="auto" height="55px" alt="Bitcoin Logo">
      </div>


  </div>
