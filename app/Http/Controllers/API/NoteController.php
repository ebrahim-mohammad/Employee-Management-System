<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\NoteDepartmentRequest;
use App\Http\Requests\NoteEmployeeRequest;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();
        return $this->customeResponse(NoteResource::collection($notes),'ok',200);
    }

    public function addNoteDepartment(NoteDepartmentRequest $request, Department $department)
    {
        try {
            $note = $department->notes()->create([
                'content' => $request->content,
            ]);
            return $this->customeResponse(new NoteResource($note), 'Note created successfully', 201);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'Note not added', 400);
        }
    }

    public function addNoteEmployee(NoteEmployeeRequest $request, Employee $employee)
    {
        try {
            $note = $employee->notes()->create([
                'content' => $request->content,
            ]);
            return $this->customeResponse(new NoteResource($note), 'Note created successfully', 201);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'Note not added', 400);
        }
    }

    public function show(Note $note)
    {
        try {
            return $this->customeResponse(new NoteResource($note), ' successfully', 201);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'There was a server error. ', 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        try {
            DB::beginTransaction();
            $note->update([
                'content' => $request->content
            ]);
            DB::commit();
            return $this->customeResponse(new NoteResource($note), 'note updated successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'the note not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        try {
            $note->delete();
            return $this->customeResponse(null, 'note deleted successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'this note not found', 404);
        }
    }




}
