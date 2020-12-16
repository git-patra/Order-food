<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        return response()->json([
            'message' => 'success',
            'user' => $user
        ], 200);

        // $token = $user->createToken('token-name')->plainTextToken;

    }
}