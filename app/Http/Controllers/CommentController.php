<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Item;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $comment = new Comment();
        $comment->body = $request->comment_body;
        $comment->user()->associate($request->user());
        $item = Item::find($request->item_id);
        $item->comments()->save($comment);
        return back();
    }
    public function storeReplies(Request $request){
        $reply = new Comment();
        $reply->body = $request->get('comment');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $item = Item::find($request->item_id);
        $item->comments()->save($reply);
        return back();
    }
}
