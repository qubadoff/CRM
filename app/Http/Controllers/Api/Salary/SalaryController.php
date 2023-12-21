<?php

namespace App\Http\Controllers\Api\Salary;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\SalaryRequest;
use App\Models\Salary;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Salary::orderBy('id', 'DESC')->withTrashed()->paginate(20)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaryRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $salary = Salary::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));

            DB::commit();

            return response()->json([
                'data' => $salary
            ]);


        } catch (\Throwable $throwable)
        {
            DB::rollBack();

            return response()->json(['error' => $throwable]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(['data' => Salary::findOrFail($id) ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaryRequest $request, string $id)
    {
        DB::beginTransaction();

        try {

            $salary = Salary::findOrFail($id);

            $salary->update($request->validated());

            DB::commit();

            return response()->json(['data' => $salary]);

        } catch (\Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $employee = Salary::findOrFail($id);

            $employee->delete();

            DB::commit();

            return response()->json(['message' => 'Salary deleted !']);

        } catch (Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }
}
