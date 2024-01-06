<?php

namespace App\Http\Controllers\Api\Timesheet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timesheet\TimesheetRequest;
use App\Models\Timesheet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Timesheet::paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimesheetRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $timesheet = Timesheet::create(
                array_merge($request->validated(),
                [
                    'department_id' => json_encode($request->department_id),
                    'employee_id' => json_encode($request->employee_id),
                    'date_and_time' => json_encode($request->date_and_time)
                ])
            );

            DB::commit();

            return response()->json($timesheet);

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
        return response()->json(Timesheet::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimesheetRequest $request, int $id): JsonResponse
    {
        DB::beginTransaction();

        try {

            Timesheet::findOrFail($id)->update($request->validated());

            DB::commit();

            return response()->json(Timesheet::findOrFail($id));

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

            Timesheet::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Timesheet deleted successfully !']);

        } catch (Exception $exception)
        {
            DB::rollBack();
            return response()->json($exception);
        }
    }
}
