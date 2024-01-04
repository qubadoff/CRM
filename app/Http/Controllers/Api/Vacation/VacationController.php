<?php

namespace App\Http\Controllers\Api\Vacation;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\VacationRequest;
use App\Models\Vacation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class VacationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Vacation::orderBy('id', 'ASC')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VacationRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $vacation = Vacation::create($request->validated());

            DB::commit();

            return response()->json($vacation);

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
        return response()->json(Vacation::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacationRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            $vacation = Vacation::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json($vacation);

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

            Vacation::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Vacation delete successfully !']);

        } catch (Exception $exception)
        {
            return response()->json($exception);
        }
    }
}
