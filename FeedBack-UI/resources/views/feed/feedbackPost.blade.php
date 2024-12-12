@extends('templates.layout')

@section('contentfeed')
    <div>
        <h2 class="text-center">Feedback</h2>
    </div>
    <div>
        <div id="feedbackList">
            <!-- Feedback cards will be dynamically added here -->
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    @include('feed.addeditFD')
                </div>
            </div>
        </div>
    </div>
@endsection
