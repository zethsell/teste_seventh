<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserController extends Controller
{

    public function index(User $loggedUser): JsonResponse
    {
        try {
            if (Auth::user()->cannot('view_any_user', $loggedUser)) {
                $users = User::whereId(Auth::user()->id)->with('level')->orderBy('name','asc')->get();
            } else {
                $users = User::with('level')->get();
            }
            return response()->json(compact('users'), Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CreateUserRequest $request, User $loggedUser): JsonResponse
    {
        try {
            if (Auth::user()->cannot('create_user', $loggedUser)) {
                return response()->json(['errors' => ['Acesso não autorizado!']], Response::HTTP_FORBIDDEN);
            }

            $user = new User;
            $user->name = $request['name'];
            $user->email = strtolower($request['email']);
            $user->password = Hash::make($request['password']);
            $user->level_id = $request['level_id'];
            $user->save();

            return response()->json(compact('user'), Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id, User $loggedUser): JsonResponse
    {
        try {
            $user = User::whereId($id)->with('level')->first();

            if (Auth::user()->cannot('view_user', $user, $loggedUser)) {
                return response()->json(['errors' => ['Acesso não autorizado!']], Response::HTTP_FORBIDDEN);
            }

            return response()->json(compact('user'), Response::HTTP_OK);

        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateUserRequest $request, User $loggedUser, $id): JsonResponse
    {
        try {
            $user = User::whereId($id)->with('level')->first();

            if (Auth::user()->cannot('update_user', $user, $loggedUser)) {
                return response()->json(['errors' => ['Acesso não autorizado!']], Response::HTTP_FORBIDDEN);
            }

            $user->name = $request['name'];
            $user->email = strtolower($request['email']);
            $user->password = Hash::make($request['password']);

            if (!Auth::user()->cannot('change_level')) {
                $user->level_id = $request['level_id'];
            }

            $user->save();
            $user->refresh();

            return response()->json(compact('user'), Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(User $loggedUser, $id): JsonResponse
    {
        try {
            $user = User::whereId($id)->first();

            if (Auth::user()->cannot('delete_user', $user, $loggedUser)) {
                return response()->json(['errors' => ['Acesso não autorizado!']], Response::HTTP_FORBIDDEN);
            }

            $user->delete();

            return response()->json('ok', Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
