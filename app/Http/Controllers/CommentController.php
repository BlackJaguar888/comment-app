<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {

        $validated = $request->validate([
            'user_name' => 'required',
            'text' => 'required',
            'level' => 'required'
        ]);

        $validated['reply_id'] = $request->reply_id;

        Comment::create($validated);

        return redirect()->route("index");
    }
}
