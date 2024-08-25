<x-app-layout>
    <section class="comments-section">
        <div class="container text-body">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="header d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-body mb-0">My Comments ({{ $comments->count() }})</h4>
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

                                        @if($comment->responses->isNotEmpty())
                                            <div class="mt-4">
                                                <h6 class="fw-bold mb-0">Responses:</h6>
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
        .badge {
            font-size: 0.875em;
            font-weight: 500;
            padding: 0.5em 1em;
            border-radius: 12px;
        }
        .bg-secondary {
            background-color: #6c757d;
        }
        .fw-bold {
            font-weight: 700;
        }
        .rounded-circle {
            border-radius: 50%;
        }
        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</x-app-layout>
