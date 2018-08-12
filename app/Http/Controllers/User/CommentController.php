<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;

class CommentController extends Controller
{
    public function store(StoreComment $request) {
        if ( Comment::create($request->getContent()) ) {
            return response()->json([
                'status' => true
            ]);`
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
