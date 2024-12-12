<h2 class="text-center">Feedback</h2>
<p class="lead text-center">Leave feedback for Virginia Food</p>

<form method="POST" action="" id="feedbackForm" class="mt-4 w-100">
    <input type="hidden" id="action" value="0"> <!-- 0 for add, 1 for edit -->
    <input type="hidden" id="feedbackId">
    <div class=" form-group mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
        <div id="validationServerFeedback" class="invalid-feedback">
        Please provide a valid name.
        </div>
    </div>
    <div class=" form-group mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class=" form-group mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control" id="body" name="body" placeholder="Enter your feedback" required></textarea>
    </div>
    <div class=" form-group mb-3">
        <button id="submitButton" class="btn btn-dark w-100">Submit</button>
    </div>
</form>


