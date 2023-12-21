<?php

namespace App\Http\Controllers\Api\Deduction;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\DeductionRequest;
use App\Models\Deduction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Deduction::orderBy('id', 'DESC')->withTrashed()->paginate(20)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeductionRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $deduction = Deduction::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));

            DB::commit();

            return response()->json(['data' => $deduction]);

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
        return response()->json(['data' => Deduction::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeductionRequest $request, string $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            $deduction = Deduction::findOrFail($id);

            $deduction->update($request->validated());

            DB::commit();

            return response()->json([
                'data' => $deduction
            ]);

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
            $employee = Deduction::findOrFail($id);

            $employee->delete();

            DB::commit();

            return response()->json(['message' => 'Deduction deleted !']);

        } catch (Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }
}
