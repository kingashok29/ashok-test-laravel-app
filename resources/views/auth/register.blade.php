@extends('layouts.app')
@section('title', 'Register a free account')

@section('content')

<div class="alert alert-notification">
  <strong>information -</strong> Old users also have to create new account, sorry for inconvenient.
</div>

    <div class="panel panel-default">
        <div class="panel-heading">Register an account</div>
              <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter your username" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your valid email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="•••••" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ref_username') ? ' has-error' : '' }}">
                            <label for="ref_username" class="col-md-4 control-label">Who referred you?</label>

                            <div class="col-md-6">
                                <input id="ref_username" type="text" class="form-control" name="ref_username" placeholder="Enter username of who referred to signup." value="{{ old('ref_username') }}">

                                <span class="help-block">** Type the username of who reffered you to signup, if no one reffered to signup then leave blank.</span>

                                @if ($errors->has('ref_username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ref_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('agree') ? ' has-error' : '' }}">
                          <label for="agree" class="control-label col-md-4"> </label>
                          <div class="col-md-6">
                            <input type="checkbox" value="agree" id="agree">
                              I read all Rules, FAQs, Terms, Privacy policy available on this website and I fully agree
                              that Forex trading involve high risk and I'm investing my money on my own risk.

                              @if ($errors->has('agree'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('agree') }}</strong>
                                  </span>
                              @endif

                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Register account
                                </button>
                                <button type="reset" class="btn btn-md btn-warning">Reset form</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection
