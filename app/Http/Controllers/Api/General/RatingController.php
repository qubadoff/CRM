<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\RatingRequest;
use App\Models\Position;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Rating::paginate(15)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatingRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($data = Rating::create($request->validated()))
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
            'data' => Rating::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RatingRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            if (Rating::where('id', $id)->update($request->validated()))
            {
                DB::commit();
                return response()->json([
                    'message' => 'Successfully Updated !',
                    'data' => Rating::where('id', $id)->first()
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
    public function destroy(string $id): JsonResponse
    {
        Rating::where('id', $id)->delete();

        return response()->json([
            'message' => 'Successfully Deleted !'
        ]);
    }
}
