<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $email = strtolower($request['email']);
            $password = $request['password'];

            if (!Auth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'message' => 'Verifique os dados digitados!'
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user = User::whereId(Auth::user()->id)->with('level')->first();

            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;

            $user->token = $token;

            return response()->json(compact('user'), Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function registration(RegistrationRequest $request): JsonResponse
    {
        try {
            $level = Level::where('description', 'Client')->first();

            $user = new User;
            $user->name = $request['name'];
            $user->email = strtolower($request['email']);
            $user->password = Hash::make($request['password']);
            $user->level_id = $level->id;
            $user->save();

            return response()->json(compact('user'), Response::HTTP_OK);

        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
