<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile', ['title' => 'Profile']);

    }

    public function viewEditUser()
    {
        return view('user.edit-profile', ['title' => 'Edit Profile']);

    }

    public function update(Request $request, $id)
    {

        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Pastikan hanya gambar yang diizinkan
        ]);

        if ($request->hasFile('profile_picture')) {
            // return response()->json(['error' => 'No file uploaded'], 400);
            $file = $request->file('profile_picture');
    
            if (!$file->isValid()) {
                return response()->json(['error' => 'Invalid file'], 400);
            }
        
            // Nama file unik
            $filename = time().'_'.$file->getClientOriginalName();
        
            // Pastikan folder penyimpanan ada
            $destinationPath = storage_path('app/public/profile-pictures');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
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
        $user->save();

        return "NULL" . $imagePath;
        // return redirect('/posts')->with('success', 'Profile updated successfully!');
    }
}
