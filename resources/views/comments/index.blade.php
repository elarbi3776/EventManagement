<x-admin-layout>
    <section class="comments-section">
        <div class="container text-body">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="header d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-body mb-0">Unread comments ({{ $comments->count() }})</h4>
                    </div>

                    @foreach($comments as $comment)
                        <div class="card comment-card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex flex-start">
                                    <img src="{{ $comment->user->avatar 
                                    ? asset('storage/' . config('chatify.user_avatar.folder') . '/' . $comment->user->avatar) 
                                    : asset('storage/' . config('chatify.user_avatar.folder') . '/' . config('chatify.user_avatar.default')) }}" 
                                         alt="User Avatar" 
                                         class="rounded-circle me-3" 
                                         style="width: 50px; height: 50px;">
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <h6 class="text-primary fw-bold mb-0">{{ $comment->user->name }}</h6>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <span class="badge bg-secondary">{{ $comment->event->name }}</span>
                                        </div>
                                        <p class="mb-3">{{ $comment->content }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="{{ route('admin.comments.responses.create', $comment->id) }}" class="btn btn-sm btn-outline-primary me-2">Reply</a>
                                                <a href="#" class="btn btn-sm btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-comment-{{ $comment->id }}').submit();">Remove</a>
                                                <form id="delete-comment-{{ $comment->id }}" action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </div>

                                        @if($comment->responses->isNotEmpty())
                                            <div class="mt-4">
                                                @foreach($comment->responses as $response)
                                                    <div class="card response-card mb-3 shadow-sm">
                                                        <div class="card-body">
                                                            <div class="d-flex flex-start">
                                                                <img src="{{ $response->user->avatar 
                                                                ? asset('storage/' . config('chatify.user_avatar.folder') . '/' . $response->user->avatar) 
                                                                : asset('storage/' . config('chatify.user_avatar.folder') . '/' . config('chatify.user_avatar.default')) }}" 
                                                                        alt="User Avatar" 
                                                                        class="rounded-circle me-3" 
                                                                        style="width: 40px; height: 40px;">
                                                
                                                                <div class="w-100">
                                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                                        <div>
                                                                            <h6 class="text-secondary fw-bold mb-0">{{ $response->user->name }}</h6>
                                                                            <small class="text-muted">{{ $response->created_at->diffForHumans() }}</small>
                                                                        </div>
                                                                    </div>
                                                                    <p class="mb-3">{{ $response->content }}</p>
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <a href="#" class="btn btn-sm btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-response-{{ $response->id }}').submit();">Remove</a>
                                                                        <form id="delete-response-{{ $response->id }}" action="{{ route('admin.comments.destroy', $response->id) }}" method="POST" class="d-none">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <style>
        .comments-section {
            background-color: #f7f6f6;
            padding: 5rem 0;
        }
        .header {
            margin-bottom: 2rem;
        }
        .comment-card {
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .response-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #eef;
        }
        .text-muted {
            color: #aaa;
        }
        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
        .badge {
            font-size: 0.875em;
            font-weight: 500;
            padding: 0.5em 1em;
            border-radius: 12px;
        }
        .bg-secondary {
            background-color: #6c757d;
        }
    </style>
</x-admin-layout>
