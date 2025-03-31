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
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
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


        // return response()->json([
        //     'error_username' => 'Username is incorrect.',
        //     'error_email' => 'Email is incorrect.'
        // ], 422);
        //  return redirect('/users')->with('success-user', 'User updated successfully!');

        $user = User::where('id', $id)->first();
        // dd($user);
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'username' => 'required|unique:users,username,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
                'occupancy' => 'nullable|string|max:100',
                'bio' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:5',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validasi
            $errors = $e->validator->errors();

            // Simpan pesan error username ke dalam $errorUsername jika ada
            $errorUsername = $errors->has('username') ? 'Username sudah ada' : null;
            $errorEmail = $errors->has('email') ? 'Email sudah ada' : null;

            return response()->json([
                'error_username' => $errorUsername,
                'error_email' => $errorEmail,
                'errors' => $errors,
            ], 422);
        }

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
        $user->username = $request->username;
        $user->email = $request->email;
        $user->occupancy = $request->occupancy;
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


        return response()->json([
            'success' => 'Password updated successfully!',
            'redirect' => url('/users') // Kirim URL tujuan
        ]);

        // return "NULL" . $imagePath;
        //  return redirect('/users')->with('success-user', 'User updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $user = User::find($id);
        // dd($user);

        if (!$user) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Hapus semua post yang memiliki kategori ini
        $post = Post::where('author_id', $id);

        if ($post){
            PostsController::deleteByAuthor($id);
        }

        // Hapus kategori setelah post dihapus
        $user->delete();

        return redirect()->back()->with('success-user', 'User and its posts deleted successfully.');
    }
}
