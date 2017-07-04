@extends('layouts.app')
@section('title', 'FAQs')
@section('content')

  <h1>FAQs - Frequently asked questions.</h1>
  <p>All important questions are answered below, please read all of these to understand our website in details.</p>

  @if(!$faqs)
    <p class="text-danger">Sorry, but no FAQ found!</p>
  @else
    @foreach($faqs as $f)
      <div class="well well-lg faq-container">
        <h3>{{ $f->question }}</h3>
        <p>{{ $f->answer }}</p>
      </div>
    @endforeach
  @endif

@endsection
