<?php

namespace App\Http\Controllers\Api\Award;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\AwardRequest;
use App\Models\Award;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Award::withTrashed()->orderBy('id', 'DESC')->paginate(20)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AwardRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $award = Award::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));

            DB::commit();

            return response()->json([
                'data' => $award
            ]);

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
        return response()->json([
            'data' => Award::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AwardRequest $request, string $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            $award = Award::findOrFail($id);

            $award->update($request->validated());

            DB::commit();

            return response()->json([
                'data' => $award
            ]);

        } catch (\Throwable $throwable)
        {
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
            $employee = Award::findOrFail($id);

            $employee->delete();

            DB::commit();

            return response()->json(['message' => 'Award deleted !']);

        } catch (Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }
}