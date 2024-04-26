<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return $this->customeResponse(EmployeeResource::collection($employees), 'Employees retrieved successfully', 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        try {
            DB::beginTransaction();

            $employee = Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'department_id' => $request->department_id,
                'position' => $request->position
            ]);
            DB::commit();
            return $this->customeResponse(new EmployeeResource($employee), 'Employee created successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return $this->customeResponse(null, 'Employee not added', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        try {
            return $this->customeResponse(new EmployeeResource($employee), 'successfully', 201);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'There was a server error.', 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            DB::beginTransaction();
            $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'department_id' => $request->department_id,
                'position' => $request->position
            ]);
            DB::commit();
            return $this->customeResponse(new EmployeeResource($employee), 'Employee updated successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'the employee not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return $this->customeResponse(null, 'Employee deleted successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'this employee not found', 404);
        }
    }
}
