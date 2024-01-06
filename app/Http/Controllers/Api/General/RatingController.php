<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\RatingRequest;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Rating::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatingRequest $request)
    {
        DB::beginTransaction();

        try {
            $rating = Rating::create($request->validated());

            DB::commit();

            return response()->json($rating);

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
        return response()->json(Rating::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RatingRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            Rating::findOrFail($id)->update($request->validated());

                DB::commit();

                return response()->json(Rating::findOrFail($id));

        } catch (Exception $exception)
        {
            DB::rollBack();
            return response()->json($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            Rating::where('id', $id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Successfully Deleted !'
            ]);

        } catch (Exception $exception)
        {
            DB::rollBack();
            return response()->json($exception);
        }
    }
}
