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
    public function index(Comment $comment, $post_id)
    {
        // dd($post_id);
        $post = Post::with('user')->where('id', $post_id)->first();
        // dd($post);
        $comment = Comment::where('post_id', $post_id)->get();
        // dd($comment);
        
        // $comment_id = $comment->id();
        // $reply = Reply::where('comment_id', $comment_id)->get();
        return view('comments/index')->with([
            'post' => $post,
            'comments' => $comment
            // 'replies' => $reply
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
    public function reply($comment_id)
    {
        $comment = Comment::with('user')->where('id', $comment_id)->first();
        return view('comments/reply')->with(['comment' => $comment]);
    }
    public function reply_store(Comment $comment, Reply $reply, ReplyRequest $request, $comment_id)
    {
        $reply->reply = $request->reply_body;
        // dd($request);
        $reply->user_id = Auth::user()->id;
        $reply->comment_id = $comment_id;
        $reply->save();
        $post = Comment::where('id', $comment_id)->first();
        $post_id = $post->post_id;
        
        // $post_id->post_id = Comment::find($comment_id);
        return redirect('/comments/'.$post_id);
    }
    public function comment_edit(Comment $comment)
    {
        return view('comments/comment_edit')->with(['comment' => $comment]);
    }
    public function comment_update(Request $request, Comment $comment)
    {
        $comment->comment = $request['comment'];
        // dd($comment);
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
    public function reply_update(Request $request, $post_id, Reply $reply, Comment $comment)
    {
        // dd($request['reply']);
        $reply->reply = $request['reply'];
        // dd($reply);
        $reply->save();
        return redirect('/comments/'.$post_id);
    }
    public function reply_delete($post_id, Reply $reply)
    {
        $reply->delete();
        return redirect('/comments/'.$post_id);
    }
}
