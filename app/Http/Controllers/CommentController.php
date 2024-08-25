<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Comment;
use App\Notifications\ResponseCommentNotification;

class CommentController extends Controller
{

    public function create(Event $event)
    {
        return view('comments.create', compact( 'event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'rating' => 'required|integer|min:0|max:5',
        ]);

        $comment = new Comment([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'user_id' => auth()->id(),
        ]);

        $event->comments()->save($comment);

        return redirect()->route('dashboard')
                         ->with('success', 'Comment added successfully.');
    }
     
    

    public function allComments()
    {
        $comments = Comment::with('user', 'event', 'responses')
                        ->whereNull('parent_id')
                        ->get();
        return view('comments.index', compact('comments'));
    }



    public function allCommentsO()
    {
        $comments = Comment::with('user', 'event', 'responses')
                        ->whereNull('parent_id')
                        ->get();
        return view('comments.org', compact('comments'));
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function createResponse(Comment $comment)
    {
        return view('comments.create-response', compact('comment'));
    }

    public function storeResponse(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $response = new Comment([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'event_id' => $comment->event_id,
            'parent_id' => $comment->id,
        ]);

        $comment->responses()->save($response);
        $comment->user->notify(new ResponseCommentNotification($comment));

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Response added successfully.');
    }

    public function userComments()
    {
        $user = auth()->user();
        $comments = Comment::with('responses', 'event')
                        ->where('user_id', $user->id)
                        ->whereNull('parent_id')
                        ->get();

        return view('comments.user-comments', compact('comments'));
    }

}
