<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => $fields['password']
        ]);

        $token = $user->createToken('fsdfsffsfsf!99')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken();
        return ['message' => 'loggouted'];
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = $this->user->getUserByEmail($fields['email']);

        if (!$user || !$this->user->CheckUser($fields['password'], $user->password)) {
            return response()->json(['message' => 'user không hợp lệ'], 401);
        }
        $tokenString = "230fdflsfkslfklsk!@#df.;'";
        $token = $user->createToken($tokenString)->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 200);
    }
}
