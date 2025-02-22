<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts', [
            'title' => 'Blog',
            'posts' => Post::filter(request(['search', 'category', 'author']))
                ->latest()
                ->paginate(12)
                ->withQueryString()
        ]);
    }

    public function post(Post $post){
        return view('post', ['title' => 'Single Post', 'post' => $post]);
    }
}
