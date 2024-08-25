<x-admin-layout>
    <section class="comments-section">
        <div class="container text-body">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="header d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-body mb-0">Respond to Comment</h4>
                    </div>

                    <form action="{{ route('admin.comments.responses.store', $comment->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="content" class="form-label">Response</label>
                            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit Response</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>
