<?php

namespace App\Http\Controllers\Api\Avans;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\AvansRequest;
use App\Models\Avans;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class AvansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Avans::orderBy('id', 'DESC')->withTrashed()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvansRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $avans = Avans::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));

            DB::commit();

            return response()->json($avans);

        } catch (Exception $exception)
        {
            DB::rollBack();

            return response()->json($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Avans::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvansRequest $request, int $id)
    {
        DB::beginTransaction();

        try {

            $avans = Avans::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json($avans);

        } catch (Exception $exception)
        {
            DB::rollBack();

            return response()->json($exception);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            Avans::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Avans deleted !']);

        } catch (Exception $exception)
        {
            DB::rollBack();
            return response()->json($exception);
        }
    }
}
