<?php

namespace App\Http\Controllers\Api\Award;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\AwardRequest;
use App\Models\Award;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Award::withTrashed()->orderBy('id', 'DESC')->paginate(20));
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

            return response()->json($award);

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
        return response()->json(Award::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AwardRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            $award = Award::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json($award);

        } catch (Exception $exception)
        {
            return response()->json( $exception );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            Award::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Award deleted !']);

        } catch (Exception $exception)
        {
            DB::rollBack();
            return response()->json($exception);
        }
    }
}
