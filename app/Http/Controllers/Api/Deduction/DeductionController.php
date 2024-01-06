<?php

namespace App\Http\Controllers\Api\Deduction;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\DeductionRequest;
use App\Models\Deduction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Deduction::orderBy('id', 'DESC')->withTrashed()->paginate(20));
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

            return response()->json($deduction);

        } catch (Exception $exception)
        {
            DB::rollBack();

            return response()->json($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(Deduction::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeductionRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            Deduction::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json(Deduction::findOrFail($id));

        } catch (Exception $exception)
        {
            DB::rollBack();

            return response()->json(['error' => $exception]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            Deduction::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Deduction deleted !']);

        } catch (Exception $exception)
        {
            DB::rollBack();
            return response()->json($exception);
        }
    }
}
