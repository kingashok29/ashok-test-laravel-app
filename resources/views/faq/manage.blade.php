@extends('layouts.app')
@section('title', 'Manage FAQs')
@section('content')

  <h1>All FAQs</h1>
  <p>List of all available faqs, you can edit/delete/add faqs here.</p>

  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#newFaq"><i class="fa fa-plus-square"></i> Add new FAQ </button>

  <hr>

    @if($faqs->count() == 0)

      <div class="well no-plan">
        <h3>Sorry, but no faqs exist in database :( </h3>
      </div>

    @else

      <table class="table table-hover">
        <thead>
          <tr>
            <td>Question</td>
            <td>Answer</td>
            <td>Actions</td>
          </tr>
        </thead>
        <tbody>

            @foreach($faqs as $f)
              <tr>
                <td>{{ $f->question }}</td>
                <td>{{ str_limit($f->answer, 70) }}</td>
                <td>
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editFaq-{{ $f->id }}"><i class="fa fa-edit"></i></button>

                  <div id="editFaq-{{ $f->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content col-md-10">
                        <div class="modal-body">

                          <form class="form-horizontal" action="{{ route('faq.update', $f->id) }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="question">Question:</label>
                                <input type="text" class="form-control" name="question" id="question" value="{{ $f->question }}">
                              </div>

                              <div class="form-group">
                                <label for="answer">Answer:</label>
                                <textarea name="answer" class="form-control" id="answer" rows="6">{{ $f->answer }}</textarea>
                              </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">Update FAQ</button>
                                <button data-dismiss="modal" class="btn btn-sm btn-danger">Close</button>
                              </div>

                          </form>

                        </div>
                      </div>
                    </div>
                  </div>

                  <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteFaq-{{ $f->id }}"><i class="fa fa-trash"></i></button>

                  <div id="deleteFaq-{{ $f->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">

                          <h3 class="text-center">Are you sure? </h3>

                            <form class="text-center form-horizontal" action="{{ route('faq.delete', $f->id) }}" method="post">
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


  <div id="newFaq" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content col-md-10">
        <div class="modal-body">

            <form class="form-horizontal" action="{{ route('faq.store') }}" method="post">
              {{ csrf_field() }}

              <div class="form-group">
                  <label for="question">Question:</label>
                  <input type="text" class="form-control" name="question" id="question" placeholder="Enter your question">
                </div>

                <div class="form-group">
                  <label for="answer">Answer:</label>
                  <textarea name="answer" class="form-control" id="answer" rows="6" placeholder="Enter your answer"></textarea>
                </div>

              <div class="form-group">
                  <button type="submit" class="btn btn-sm btn-success">Add new FAQ</button>
                  <button data-dismiss="modal" class="btn btn-sm btn-danger">Close</button>
                </div>

            </form>

        </div>
      </div>
    </div>
  </div>

@endsection
