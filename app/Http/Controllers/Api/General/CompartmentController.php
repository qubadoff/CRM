<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\CompartmentRequest;
use App\Models\Compartment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CompartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Compartment::paginate(15)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompartmentRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($data = Compartment::create($request->validated()))
            {
                DB::commit();

                return response()->json([
                    'data' => $data
                ]);
            }

        } catch (\Throwable $throwable)
        {
            DB::rollBack()
            ;
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
            'data' => $compartment = Compartment::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompartmentRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            if (Compartment::where('id', $id)->update($request->validated()))
            {
                DB::commit();
                return response()->json([
                    'message' => 'Successfully Updated !',
                    'data' => Compartment::where('id', $id)->first()
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
        Compartment::where('id', $id)->delete();

        return response()->json([
            'message' => 'Successfully Deleted !'
        ]);
    }
}
