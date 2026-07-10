<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CommentController extends Controller implements HasMiddleware
{

    public static function middleware() : array
    {
        return [
            new Middleware('auth')
        ];
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id'
        ]);
        Comment::create([
            'body' => $validated['comment'],
            'post_id' => $validated['post_id'],
            'user_id' => auth()->id(),
        ]);
        return redirect()->back()->with('alert','comment added successfuly.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        $comment->body = $validated['comment'];
        $comment->save();
        return redirect()->back()->with('alert','comment updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();
        return redirect()->back()->with('alert','comment deleted successfuly.');        
    }
}
