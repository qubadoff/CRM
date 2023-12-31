<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\DepartmentRequest;
use App\Models\Departments;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Departments::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $department = Departments::create($request->validated());

            DB::commit();

            return response()->json($department);

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
        return response()->json(Departments::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            Departments::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json(Departments::findOrFail($id));

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
            Departments::findOrFail($id)->delete();

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
