<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Str;
class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;
    public function index()
    {

        $this->authorize('is_admin');
        return view('user.admin.category', [
            'title' => 'Category',
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'category-name' => 'required|string|max:255|unique:categories,name',
            'category-color' => 'required'
        ]);
    
        // Generate slug dari nama kategori
        $slug = Str::slug($validatedData['category-name']);
        $originalSlug = $slug;
        
        // Tambahkan angka jika slug sudah ada
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
    
        // Simpan ke database
        Category::create([
            'name' => $validatedData['category-name'],
            'slug' => $slug,
            'color' => $validatedData['category-color']
        ]);
    
        return redirect()->back()->with('success-category', 'Category added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }
    
        // Hapus semua post yang memiliki kategori ini
        Post::where('category_id', $id)->delete();
    
        // Hapus kategori setelah post dihapus
        $category->delete();
    
        return redirect()->back()->with('success-category', 'Category and its posts deleted successfully.');
    }
}
