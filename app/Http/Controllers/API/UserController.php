<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->$user = $user;
    }
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