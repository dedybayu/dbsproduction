<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Str;

class PostsController extends Controller
{
    //
    public function index()
    {
        return Auth::check()
            ? view('admin.posts', [
                'title' => 'All Posts',
                'posts' => Post::filter(request(['search', 'category', 'author']))
                    ->latest()
                    ->paginate(12)
                    ->withQueryString()
            ])
            : view('posts', [
                'title' => 'Blog',
                'posts' => Post::filter(request(['search', 'category', 'author']))
                    ->latest()
                    ->paginate(12)
                    ->withQueryString()
            ]);
    }

    public function myPosts()
    {
        return view('admin.posts', [
            'title' => 'My Posts',
            'posts' => Post::whereHas('author', function ($query) {
                    $query->where('username', auth()->user()->username);
                })
                ->when(request('category'), function ($query) {
                    $query->whereHas('category', function ($q) {
                        $q->where('slug', request('category'));
                    });
                }) // Tambahkan filter berdasarkan kategori
                ->filter(request(['search'])) // Hanya filter search, karena kategori sudah ditangani di atas
                ->latest()
                ->paginate(12)
                ->withQueryString()
        ]);
    }

    public function post(Post $post)
    {
        if (Auth::check()) {
            if (Auth::id() == $post->author_id) {
                return view('admin.mypost', ['title' => 'Single Post', 'post' => $post]);       
            } else {
                return view('admin.post', ['title' => 'Single Post', 'post' => $post]);
            }
        } else {
            return view('post', ['title' => 'Single Post', 'post' => $post]);
        }    
    }

    public function createPost(Post $post)
    {
        return view('admin.create', ['title' => 'Create Post', 'categories' => Category::all()]);
    }

    public function store(Request $request) {
        // Generate slug awal
        $slug = Str::slug($request->title);
        $originalSlug = $slug; // Simpan slug asli
    
        // Cek apakah slug sudah ada di database
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
    
        // Tambahkan slug ke request
        $request->merge(['slug' => $slug]);
    
        // dd($request->all()); // Debugging
        // dd(auth()->id());
        Post::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'author_id' => auth()->id(),
            'body' => $request->body,
            'slug' => $slug
        ]);

        return redirect('/myposts')->with('success-create-posts', 'Successfully created a post!');

    }


}
