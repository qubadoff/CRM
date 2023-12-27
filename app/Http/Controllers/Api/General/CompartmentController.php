<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\CompartmentRequest;
use App\Models\Compartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class CompartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Compartment::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompartmentRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $compartment = Compartment::create($request->validated());
                DB::commit();

                return response()->json($compartment);

        } catch (\Throwable $throwable)
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
        return response()->json(Compartment::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompartmentRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            Compartment::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json(Compartment::where('id', $id)->first());

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
        Compartment::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Successfully Deleted !'
        ]);
    }
}
