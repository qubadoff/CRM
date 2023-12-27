<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\PositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Position::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $position = Position::create($request->validated());

            DB::commit();

            return response()->json($position);

        } catch (Throwable $throwable)
        {
            DB::rollBack();

            return response()->json($throwable);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Position::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            Position::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json(Position::where('id', $id)->first());

        } catch (Throwable $throwable)
        {
            DB::rollBack();

            return response()->json($throwable);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        Position::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Successfully Deleted !'
        ]);
    }
}
