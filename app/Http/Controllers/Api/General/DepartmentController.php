<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\DepartmentRequest;
use App\Models\Departments;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Departments::paginate(15)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($data = Departments::create($request->validated()))
            {
                DB::commit();
                return response()->json([
                    'message' => 'Department created successfully !',
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
            'data' => Departments::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            if (Departments::where('id', $id)->update($request->validated()))
            {
                DB::commit();
                return response()->json([
                    'message' => 'Successfully Updated !',
                    'data' => Departments::where('id', $id)->first()
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
        Departments::where('id', $id)->delete();

        return response()->json([
            'message' => 'Successfully Deleted !'
        ]);
    }
}
