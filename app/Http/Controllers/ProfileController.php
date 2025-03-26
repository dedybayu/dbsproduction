<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
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

    public function update(Request $request)
    {
        // if ($request->input('remove_picture') == "1") {
        //     return "HELLO WOLRD";
        // }
        // dd($request);
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string',
            'occupancy' => 'nullable|string',
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
        $user->occupancy = $request->occupancy;
        if ($imagePath) {
            $user->image = $imagePath;
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
        return redirect('/profile')->with('success-user', 'Profile updated successfully!');
    }


    public function update_password(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user = User::findOrFail($id);


        // Periksa apakah password lama benar
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json([
                'message' => 'Old password is incorrect.'
            ], 422);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'success' => 'Password updated successfully!',
            'redirect' => url('/profile') // Kirim URL tujuan
        ]);

        // return response()->json([
        //     'message' => 'Old password is correct',
        // ]);


        // return response()->json([
        //     // 'message' => 'bbbb',
        //     'message' => $request->new_password,
        // ]);
        // Update password baru
        // $user->update([
        //     'password' => Hash::make($request->input('new-password')),
        // ]);


    }


    // public function update_password(Request $request, $id)
    // {
    //     return response()->json([
    //         'message' => 'Old password is correct',
    //     ]);

    // }

}
