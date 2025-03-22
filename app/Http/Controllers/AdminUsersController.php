<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Storage;

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
    public function edit($id)
    {
        return User::where('id', $id)->first();
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //  dd($request);
        
         $user = User::where('id', $id)->first();
        // dd($user);
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . $user->id,
             'bio' => 'nullable|string',
             // 'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan hanya gambar yang diizinkan
         ]);
 
         if ($request->hasFile('profile_picture')) {
             // return response()->json(['error' => 'No file uploaded'], 400);
             $file = $request->file('profile_picture');
 
             if (!$file->isValid()) {
                 return response()->json(['error' => 'Invalid file'], 400);
             }
 
             // Nama file unik
             $filename = time() . '_' . $file->getClientOriginalName();
 
             // Pastikan folder penyimpanan ada
             $destinationPath = storage_path('app/public/profile-pictures');
             if (!file_exists($destinationPath)) {
                 mkdir($destinationPath, 0775, true);
             }
             
             // Hapus file lama jika ada
             $oldImage = $user->image ?? null; // Ambil path file lama dari database
             if ($oldImage) {
                 $oldFilePath = storage_path("app/public/$oldImage");
                 if (file_exists($oldFilePath)) {
                     Storage::delete($user->image);
                 }
             }
 
             // Pindahkan file
             $file->move($destinationPath, $filename);
 
             $imagePath = "profile-pictures/$filename"; // Simpan path gambar
         } else {
             $imagePath = null;
             // return  . $imagePath;
         }
 
         // Update data lainnya
         $user->name = $request->name;
         $user->email = $request->email;
         $user->bio = $request->bio;
         if ($imagePath) {
             $user->image = $imagePath;
         }
         
         if ($request->password) {
            $user->password = $request->password;
         }
         
         if ($request->input('remove_picture') == "1") {
             // Hapus gambar lama jika ada
             if ($user->image) {
                 $oldFilePath = storage_path("app/public/" . $user->image);
                 if (file_exists($oldFilePath)) {
                     Storage::delete($user->image);
                 }
             }
             $user->image = null; // Set kolom di database jadi null
         }
         $user->save();
 
         // return "NULL" . $imagePath;
         return redirect('/users')->with('success', 'User updated successfully!');

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
