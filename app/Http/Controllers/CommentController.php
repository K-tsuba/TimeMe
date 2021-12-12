<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\User;
use App\Reply;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\ReplyRequest;

use Illuminate\Http\Request;

use Auth;

class CommentController extends Controller
{
    public function index(Comment $comment, $post_id, Post $post)
    {
        return view('comments/index')->with([
            'post' => $post->PostFirst($post_id),
            'comments' => $comment->getComment($post_id)
        ]);
    }
    public function create()
    {
        return view('comments/create');
    }
    public function store(Comment $comment, CommentRequest $request, $post_id)
    {
        $comment->comment = $request->comment_body;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post_id;
        $comment->save();
        return redirect('/comments/'.$post_id);
    }
    public function reply($comment_id, Comment $comment)
    {
        return view('comments/reply')->with(['comment' => $comment->CommentFirst($comment_id)]);
    }
    public function reply_store(Comment $comment, Reply $reply, ReplyRequest $request, $comment_id, $post_id)
    {
        $reply->reply = $request->reply_body;
        $reply->user_id = Auth::user()->id;
        $reply->comment_id = $comment_id;
        $reply->save();
        return redirect('/comments/'.$post_id);
    }
    public function comment_edit(Comment $comment)
    {
        return view('comments/comment_edit')->with(['comment' => $comment]);
    }
    public function comment_update(CommentRequest $request, Comment $comment)
    {
        $comment->comment = $request['comment'];
        $comment->save();
        return redirect('/comments/'.$comment->post_id);
    }
    public function comment_delete(Comment $comment)
    {
        $comment->delete();
        return redirect('/comments/'.$comment->post_id);
    }
    public function reply_edit($post_id, Reply $reply)
    {
        return view('comments/reply_edit')->with([
            'reply' => $reply,
            'post_id' => $post_id
        ]);
    }
    public function reply_update(ReplyRequest $request, $post_id, Reply $reply, Comment $comment)
    {
        $reply->reply = $request['reply'];
        $reply->save();
        return redirect('/comments/'.$post_id);
    }
    public function reply_delete($post_id, Reply $reply)
    {
        $reply->delete();
        return redirect('/comments/'.$post_id);
    }
}
