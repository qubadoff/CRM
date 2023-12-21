<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => User::orderBy('id', 'DESC')->withTrashed()->paginate(20)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->validated());

            DB::commit();

            return response()->json([['data' => $user]]);

        } catch (\Throwable $throwable)
        {
            DB::rollBack();

            return response()->json(['error' => $throwable]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(['data' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);

            $user->update($request->validated());

            DB::commit();

            return response()->json(['data' => $user]);

        } catch (\Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $user->delete();

            DB::commit();

            return response()->json(['message' => 'User deleted !']);

        } catch (Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }
}
