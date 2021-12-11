<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {

        $comments = Comment::with('replies')->where('level', 1)->get();

        return Inertia::render('Index', ['comments' => $comments]);
    }
}
