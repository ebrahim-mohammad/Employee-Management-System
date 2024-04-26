<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return $this->customeResponse(ProjectResource::collection($projects), 'Projects retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        try {
            DB::beginTransaction();

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        DB::commit();
            return $this->customeResponse(new ProjectResource($project), 'project created successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error($th);
        return $this->customeResponse(null, 'project not added', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            return $this->customeResponse(new ProjectResource($project), ' successfully', 201);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'There was a server error. ', 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        try {
            DB::beginTransaction();
            $project->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();
            return $this->customeResponse(new ProjectResource($project), 'project updated successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'the project not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return $this->customeResponse(null, 'project deleted successfully', 200);
        } catch (\Throwable $th) {
            return $this->customeResponse(null, 'this project not found', 404);
        }
    }
}
