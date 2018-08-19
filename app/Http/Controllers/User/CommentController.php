<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('status');
        return $this->middleware(['auth']);
    }
    public function store(StoreComment $request) {
        if ( Comment::create($request->getContent()) ) {
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function active(Request $request) {
        $this->validate($request, [
           'comment' => 'required|integer|min:1'
        ]);
        if(Comment::activeComment($request->getContent())) {
            return response()->json([
                'status' => 'true',
            ]);
        }
        return response()->json([
            'status' => 'false',
        ]);
    }

    public function delete(Request $request) {
        $this->validate($request, [
            'comment' => 'required|integer|min:1'
        ]);
        if(Comment::deleteComment($request->getContent())) {
            return response()->json([
                'status' => 'true',
            ]);
        }
        return response()->json([
            'status' => 'false',
        ]);
    }
}
