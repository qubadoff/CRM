<?php

namespace App\Http\Controllers\Api\Avans;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\AvansRequest;
use App\Models\Avans;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class AvansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Avans::orderBy('id', 'DESC')->withTrashed()->paginate(20)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvansRequest $request)
    {
        DB::beginTransaction();

        try {

            $avans = Avans::create(array_merge($request->validated(), ['user_id' => auth()->user()->id]));

            DB::commit();

            return response()->json(['data' => $avans]);

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
        return response()->json([
            'data' => Avans::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvansRequest $request, string $id)
    {
        DB::beginTransaction();

        try {

            $avans = Avans::findOrFail($id);

            $avans->update($request->validated());

            DB::commit();

            return response()->json([
                'data' => $avans
            ]);

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
            $employee = Avans::findOrFail($id);

            $employee->delete();

            DB::commit();

            return response()->json(['message' => 'Avans deleted !']);

        } catch (Throwable $throwable)
        {
            DB::rollBack();
            return response()->json(['error' => $throwable]);
        }
    }
}
