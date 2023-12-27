<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\EmployeeRequest;
use App\Http\Requests\General\EmployeeupdateRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeController extends Controller
{
    public function __construct(){}

    public function index(): JsonResponse
    {
        $employees = Employee::with(['media'])->withTrashed()->orderBy('id', 'DESC')->paginate(20);

        return response()->json([
            'data' => $employees->transform(function (Employee $employee) {
                $userPhoto = $employee->getFirstMedia('user_photo');
                $userPhotoUrl = optional($userPhoto)->getUrl();

                $userDocuments = $employee->getMedia('user_documents');
                $documents = $userDocuments->map(function ($media) {
                    return [
                        'name' => $media->name,
                        'document_url' => $media->getUrl(),
                    ];
                });

                return array_merge(
                    $employee->toArray(),
                    compact('userPhotoUrl', 'documents')
                );
            }),
            'pagination' => $employees->toArray(),
        ]);
    }

    public function store(EmployeeRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $employee = Employee::create($request->all());

            $employee->addMediaFromRequest('user_photo')->toMediaCollection('user_photos');

            $employee->addMultipleMediaFromRequest(['user_documents'])->each(function ($fileAdd) {
                $fileAdd->toMediaCollection('user_documents');
            });

                DB::commit();

                return response()->json($employee);

        } catch (Throwable $throwable)
        {
            DB::rollBack();

            return response()->json($throwable);
        }
    }

    public function show($id): JsonResponse
    {
        $employee = Employee::with(['media'])->withTrashed()->find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $userPhotoUrl = optional($employee->getFirstMedia('user_photo'))->getUrl();

        $userDocuments = $employee->getMedia('user_documents');
        $documents = $userDocuments->map(function ($media) {
            return [
                'name' => $media->name,
                'document_url' => $media->getUrl(),
            ];
        });

        $employeeData = array_merge(
            $employee->toArray(),
            compact('userPhotoUrl', 'documents')
        );

        return response()->json($employeeData);
    }

    public function update(EmployeeupdateRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $employee = Employee::findOrFail($id);
            $employee->update($request->all());

            if ($request->hasFile('user_photo')) {
                $employee->clearMediaCollection('user_photo');
                $employee->addMediaFromRequest('user_photo')->toMediaCollection('user_photo');
            }

            DB::commit();

            $updatedEmployee = Employee::with(['media'])->find($id);

            $userPhoto = $updatedEmployee->getFirstMedia('user_photo');
            $userPhotoUrl = optional($userPhoto)->getUrl();

            $userDocuments = $updatedEmployee->getMedia('user_documents');
            $documents = $userDocuments->map(function ($media) {
                return [
                    'name' => $media->name,
                    'document_url' => $media->getUrl(),
                ];
            });

            $employeeData = array_merge(
                $updatedEmployee->toArray(),
                compact('userPhotoUrl', 'documents')
            );

            return response()->json($employeeData);
        } catch (Throwable $e) {

            DB::rollBack();

            return response()->json(['message' => 'Update failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $employee = Employee::findOrFail($id)->delete();

            DB::commit();

            return response()->json(['message' => 'Employee deleted !']);

        } catch (Throwable $throwable)
        {
            DB::rollBack();
            return response()->json($throwable);
        }
    }
}
