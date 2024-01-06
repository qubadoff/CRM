<?php

namespace App\Http\Controllers\Api\Salary;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\SalaryRequest;
use App\Models\Salary;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Salary::orderBy('id', 'DESC')->withTrashed()->paginate(20));
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

            return response()->json($salary);


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
        return response()->json(Salary::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaryRequest $request, int $id)
    {
        DB::beginTransaction();

        try {

            Salary::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json(Salary::findOrFail($id));

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
            Salary::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Salary deleted !']);

        } catch (Exception $exception)
        {
            DB::rollBack();

            return response()->json($exception);
        }
    }
}
