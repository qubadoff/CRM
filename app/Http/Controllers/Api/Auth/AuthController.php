<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['user', 'logout']);
    }

    public function login(AuthRequest $request): JsonResponse
    {
        if (! Auth::guard('api')->attempt($request->validated()))
        {
            return response()->json(['message' => 'Invalid credentials !'], 401);
        }

        $user = Auth::user();

        $user->tokens()->delete();

        $token = $user->createToken('UserLoginToken')->plainTextToken;

        $expires_in = config('sanctum.expiration');

        DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->update([
            'expires_at' => now()->addMinutes($expires_in),
        ]);

        return response()->json(['token' => $token, 'expires_in' => $expires_in, 'user' => \auth('api')->user()
        ]);
    }

    public function register(AuthRegisterRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = User::create($request->validated());

            DB::commit();

            $user->tokens()->delete();

            $token = $user->createToken('UserLoginToken')->plainTextToken;

            $expires_in = config('sanctum.expiration');

            DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->update([
                'expires_at' => now()->addMinutes($expires_in),
            ]);

            return response()->json([
                'message' => 'Registration success !',
                'access_token' => $token,
                'expires_in' => $expires_in,
                'user' => $user,
            ]);
        } catch (Exception $exception) {
            DB::rollBack();

            return response()->json(['error' => $exception]);
        }
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out !']);
    }
}
