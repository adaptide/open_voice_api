<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

final class OrganizationController
{
    public function __invoke()
    {
        $organization = Auth::guard('sanctum')->user()->organization;
        if (!$organization) {
            throw new HttpResponseException(response()->json([
                'status' => 'failed',
                'message' => 'Organization not found'
            ], Response::HTTP_NOT_FOUND));
        }
        return response()->json(
            OrganizationResource::make($organization->load('projects'))
        );
    }
}
