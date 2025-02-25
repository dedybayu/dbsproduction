<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class PostsController extends Controller
{
    //
    public function index()
    {
        return Auth::check()
            ? view('user.posts', [
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
        return view('user.myposts', [
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
                return view('user.mypost', ['title' => 'Single Post', 'post' => $post]);
            } else {
                return view('user.post', ['title' => 'Single Post', 'post' => $post]);
            }
        } else {
            return view('post', ['title' => 'Single Post', 'post' => $post]);
        }
    }

    public function createPost(Post $post)
    {
        return view('user.create', ['title' => 'Create Post', 'categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file-upload')) {
            // return response()->json(['error' => 'No file uploaded'], 400);
            $file = $request->file('file-upload');
    
            if (!$file->isValid()) {
                return response()->json(['error' => 'Invalid file'], 400);
            }
        
            // Nama file unik
            $filename = time().'_'.$file->getClientOriginalName();
        
            // Pastikan folder penyimpanan ada
            $destinationPath = storage_path('app/public/post-images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
        
            // Pindahkan file
            $file->move($destinationPath, $filename);
        
            $imagePath = "post-images/$filename"; // Simpan path gambar
        } else {
            $imagePath = null;
        }
    
        // Generate slug awal
        $slug = Str::slug($request->title);
        $originalSlug = $slug; // Simpan slug asli
    
        // Cek apakah slug sudah ada di database
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
    
        // Simpan data ke database
        Post::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'author_id' => auth()->id(),
            'body' => $request->body,
            'slug' => $slug,
            'image' => $imagePath // Menyimpan path gambar dalam database
        ]);
    
        return redirect('/myposts')->with('success-post', 'Successfully created a post!');
    }
    


    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if (Auth::id() !== $post->author_id) {
            abort(403, 'The post is not yours');
        }

        // return 'hello';

        $title = "Edit Post";
        $categories = Category::all();
        return view('user.edit-post', compact('post', 'title', 'categories'));
    }

    // Memproses update post (hanya untuk pemilik post)
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($request->hasFile('file-upload')) {
            // return response()->json(['error' => 'No file uploaded'], 400);
            $file = $request->file('file-upload');
    
            if (!$file->isValid()) {
                return response()->json(['error' => 'Invalid file'], 400);
            }
            
            // Nama file unik
            $filename = time().'_'.$file->getClientOriginalName();
        
            // Hapus Gambar Lama
            Storage::delete($post->image);

            // Pastikan folder penyimpanan ada
            $destinationPath = storage_path('app/public/post-images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
        
            // Pindahkan file
            $file->move($destinationPath, $filename);
        
            $imagePath = "post-images/$filename"; // Simpan path gambar

        } else {
            $imagePath = $post->image;
        }

        // Cek apakah user saat ini adalah pemilik post
        if (Auth::id() !== $post->author_id) {
            abort(403, 'The post is not yours');
        }

        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        $newslug = Str::slug($request->input('title'));

        // Update data
        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $request->input('category'),
            'slug' => $newslug,
            'image' => $imagePath
        ]);

        return redirect('/myposts')->with('success-post', 'Post successfully updated!');
    }

    public function destroy($id)
    {
        $data = Post::find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Post not found!');
        }

        $data->delete();
        Storage::delete($data->image);

        return redirect('/myposts')->with('success-post', 'Post successfully deleted!');
    }
}
