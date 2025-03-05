<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('is_admin');
        return view('user.admin.users', [
            'title' => 'Users',
            'users' => User::all()
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        dd($id);
        // $user = User::find($id);

        // if (!$user) {
        //     return redirect()->back()->with('error', 'Category not found.');
        // }

        // // Hapus semua post yang memiliki kategori ini
        // Post::where('user_id', $id)->delete();

        // // Hapus kategori setelah post dihapus
        // $user->delete();

        // return redirect()->back()->with('success-category', 'Category and its posts deleted successfully.');
    }
}
