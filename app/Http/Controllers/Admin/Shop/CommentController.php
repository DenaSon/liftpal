<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function liveReplySave(Request $request)
    {
        $request->validate([
            'reply_text' => 'nullable|string|max:255',
            'comment_id' => 'exists:comments,id',
        ]);

       $reply = $request->post('reply_text');
       $comment_id = $request->post('comment_id');
       if( Comment::where('id', $comment_id)
            ->update(['reply' => $reply]))
       {
           return response()->json(['message' => 'success'],200);
       }

        return response()->json(['message' => 'error'],400);

    }

    public function liveDeleteComment(Request $request)
    {
        $request->validate([

            'comment_id' => 'exists:comments,id',
        ]);


              $comment_id = $request->post('comment_id');
              Comment::where('id', $comment_id) ->delete();

             return response()->json(['message' => 'success'],200);


    }

    public function liveConfirmComment(Request $request)
    {
        $request->validate([

            'comment_id' => 'exists:comments,id',
        ]);

        $comment_id = $request->post('comment_id');
        $comment = Comment::find($comment_id);
        if($comment->status == 'published')
        {
            $comment->status = 'hidden';
            $comment->save();
            return response()->json(['message' => 'publish'],200);

        }
        else
        {
            $comment->status = 'published';
            $comment->save();
            return response()->json(['message' => 'hidden'],200);

        }

    }






}
