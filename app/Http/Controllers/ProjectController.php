<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class ProjectController
{

    public function index()
    {
        $projects = Auth::guard('sanctum')->user()->organization->projects;
        return response()->json(ProjectResource::collection($projects));
    }

    public function show(Project $project)
    {
        return response()->json(ProjectResource::make($project->load('texts')));
    }
}
