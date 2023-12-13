<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\PositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Position::paginate(15)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($data = Position::create($request->validated()))
            {
                DB::commit();
                return response()->json([
                    'data' => $data
                ]);
            }
        } catch (\Throwable $throwable)
        {
            DB::rollBack();
            return response()->json([
                'errors' => $throwable
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json([
            'data' => Position::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            if (Position::where('id', $id)->update($request->validated()))
            {
                DB::commit();
                return response()->json([
                    'message' => 'Successfully Updated !',
                    'data' => Position::where('id', $id)->first()
                ]);
            }
        } catch (\Throwable $throwable)
        {
            DB::rollBack();
            return response()->json([
                'errors' => $throwable
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Position::where('id', $id)->delete();

        return response()->json([
            'message' => 'Successfully Deleted !'
        ]);
    }
}
