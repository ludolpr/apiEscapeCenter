<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
        // voir pourquoi ici le middleware me bloque 
        // $this->middleware('auth:api', ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all users
        $users = User::all();
        // Return user in JSON
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'picture_user' => 'required|image|max:5000'
        ]);

        $filename = "";
        if ($request->hasFile('picture_user')) {
            $filenameWithExt = $request->file('picture_user')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_user')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('picture_user')->storeAs('public/uploads/users', $filename);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'picture_user' => $filename,
        ]);

        // JSON informations !
        return response()->json([
            'status' => 'Success',
            'data' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Return the user information in JSON
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'picture_user' => 'sometimes|image|max:5000'
        ]);

        if ($request->hasFile('picture_user')) {
            // Delete old file
            if ($user->picture_user) {
                Storage::delete('public/uploads/users/' . $user->picture_user);
            }

            $filenameWithExt = $request->file('picture_user')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture_user')->getClientOriginalExtension();
            $filename = $filename . '_' . time() . '.' . $extension;
            $request->file('picture_user')->storeAs('public/uploads/users', $filename);

            $user->picture_user = $filename;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'picture_user' => $user->picture_user
        ]);

        // Return the updated information in JSON
        return response()->json([
            'status' => 'Update OK',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user
        if ($user->picture_user) {
            Storage::delete('public/uploads/users/' . $user->picture_user);
        }

        $user->delete();

        // Return the response in JSON
        return response()->json([
            'status' => 'Delete OK',
        ]);
    }

    /**
     * Get the current authenticated user.
     */
    public function currentUser()
    {
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Utilisateur data ok',
            ],
            'data' => [
                'user' => auth()->user(),
            ],
        ]);
    }
}