@extends('templates.header')

@section('content')
<h2>Feedback</h2>
<p class="lead text-center">Leave feedback for Virginia Food</p>

<form method="POST" action="" class="mt-4 w-75">
    @csrf
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="">
    <div id="validationServerFeedback" class="invalid-feedback">
      Please provide a valid name.
    </div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="">
  </div>
  <div class="mb-3">
    <label for="body" class="form-label">Feedback</label>
    <textarea class="form-control" id="body" name="body" placeholder="Enter your feedback"></textarea>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
  </div>
</form>
@endsection
