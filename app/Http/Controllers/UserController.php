<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->all());
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->create($request->validated());

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = $this->userService->find($id);

        if (! $user) {
            return response()->json(['message' => 'User não encontrado.'], 404);
        }

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->update($request->validated(), $id);

        if (! $user) {
            return response()->json(['message' => 'User não encontrado.'], 404);
        }

        return response()->json($user);
    }

    public function destroy($id)
    {
        if (Auth::id() == $id) {
            return response()->json(['message' => 'Você não tem permissão para excluir este usuário.'], 403);
        }

        $deleted = $this->userService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'User não encontrado.'], 404);
        }

        return response()->json(null, 204);
    }
}
