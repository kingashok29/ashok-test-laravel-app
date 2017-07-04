@extends('layouts.app')
@section('title', 'View all news')
@section('content')

  <h1>Manage all news feed</h1>
  <p>
    Add news and manage them. Only one news will appear at a time created recently on website.
  </p>
  <a href="{{ route('new.news') }}" class="btn btn-sm btn-primary" role="button"><i class="fa fa-plus-circle"> </i> Add news </a>
  <hr>

  @if(!$news->count())
    <div class="well no-transaction">
      <h3>No news found.</h3>
      <p>Create news by clicking above button.</p>
    </div>
  @else

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Title</th>
          <th>Body</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($news as $n)
          <tr>
            <td>{{ $n->news_title }}</td>
            <td>{{ $n->news_body }}</td>
            <td>
              <form class="form-horizontal" action="{{ route('news.delete', $n->id) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  @endif

@endsection
