<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return $this->customeResponse(DepartmentResource::collection($departments),'ok',200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            DB::beginTransaction();

        $department = Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        DB::commit();
            return $this->customeResponse(new DepartmentResource($department), ' created successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error($th);
        return $this->customeResponse(null, 'not added', 400);
        }
}

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return $this->customeResponse(new DepartmentResource($department), 'successfully', 201);

        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'There was a server error.', 400);
        }
      }
    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            DB::beginTransaction();
            $department->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();
            return $this->customeResponse(new DepartmentResource($department), 'the department updated', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'the department not found', 404);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return $this->customeResponse('', 'department deleted successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'this department not found', 404);
        }

    }

}
