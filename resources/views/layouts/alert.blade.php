@if (Session::has('error'))
<div class="alert alert-danger alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> {!! Session::get('error') !!}
</div>
@elseif(Session::has('success'))
<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> {!! Session::get('success') !!}
</div>
@elseif(Session::has('info'))
<div class="alert alert-info alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Information!</strong> {!! Session::get('info') !!}
</div>
@elseif(Session::has('warning'))
<div class="alert alert-warning alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Warning!</strong> {!! Session::get('warning') !!}
</div>
@endif
