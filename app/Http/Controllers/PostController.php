<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('home');
    }

    public function search($searchText) {
        $posts = Post::where('title', 'like', '%'.$searchText.'%')->get();

        return response()->json($posts);
    }
}
