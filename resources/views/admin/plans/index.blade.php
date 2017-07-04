@extends('layouts.app')
@section('title', 'All running plans')
@section('content')

  <h1>All plans</h1>
  <p>List of all available plabs, you can edit/delete/add plans here.</p>

  <a href="{{ route('plan.new') }}" role="button" class="btn btn-md btn-primary"><i class="fa fa-plus-square"></i> Add new plan</a>

  <hr>

    @if($plans->count() == 0)

      <div class="well no-plan">
        <h3>Sorry, but no plan exist in database :( </h3>
      </div>

    @else

      <table class="table table-hover">
        <thead>
          <tr>
            <td>Plan name</td>
            <td>Duration</td>
            <td>Daily profit</td>
            <td>Min ($)</td>
            <td>Max ($)</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>

            @foreach($plans as $p)
              <tr>
                <td>{{ $p->plan_name }}</td>
                <td>{{ $p->plan_duration }}</td>
                <td>{{ $p->daily_profit }}</td>
                <td>{{ $p->starting_amount }}</td>
                <td>{{ $p->ending_amount }}</td>
                <td>
                  @if($p->status == true)
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#hidePlan-{{ $p->id }}">Hide plan</button>
                  @else
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#hidePlan-{{ $p->id }}">UnHide plan</button>
                  @endif
                  <a href="{{ route('plan.edit', $p->id) }}" role="button" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                  <div id="hidePlan-{{ $p->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">

                          @if ($p->status == true)

                            <h3>You are hiding plan - <u> {{ $p->plan_name }} </u></h3>
                            <p>
                              Once you hide the plan, it will not appear on website, after some time you can
                              un-hide it and will available on website.
                            </p>

                            <form class="form-horizontal" action="{{ route('plan.hide', $p->id) }}" method="post">
                              {{ csrf_field() }}
                                <button type="submit" class="btn btn-md btn-success">Hide the plan.</button>
                            </form>

                          @else

                          <h3>You are UnHiding plan - <u> {{ $p->plan_name }} </u></h3>
                          <p>
                            So once you click the button below, the plan will appear again on website.
                          </p>

                          <form class="form-horizontal" action="{{ route('plan.unhide', $p->id) }}" method="post">
                            {{ csrf_field() }}
                              <button type="submit" class="btn btn-md btn-success">UnHide the plan.</button>
                          </form>

                          @endif

                        </div>
                      </div>
                    </div>
                  </div>

                  <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePlan-{{ $p->id }}"><i class="fa fa-trash"></i></button>

                  <div id="deletePlan-{{ $p->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">

                          <h3 class="text-center">Are you sure? </h3>
                          <p class="text-center">
                            You are about to delete the plan <u> {{ $p->plan_name }} </u> from website.
                          </p>

                            <form class="text-center form-horizontal" action="{{ route('plan.delete', $p->id) }}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-md btn-danger">Yes! Delete plan</button>
                              <button type="button" class="btn btn-md btn-primary" data-dismiss="modal">Cancel delete</button>
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
