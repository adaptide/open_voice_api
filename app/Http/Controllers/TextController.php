<?php

namespace App\Http\Controllers;

use App\Http\Resources\TextResource;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class TextController
{
    public function index(Request $request)
    {
        $texts = Text::with('project')->when(
            $request->organization,
            function ($query) use ($request) {
                return $query->whereHas('project', function ($query) use ($request) {
                    return $query->where('organization_id', $request->organization);
                });
            },
        )->paginate($request->perPage ?? 10);
        return response()->json([
            'data' => TextResource::collection($texts),
            'pagination' => [
                'total' => $texts->total(),
                'nextPageUrl' => $texts->nextPageUrl(),
                'previousPageUrl' => $texts->previousPageUrl(),
                'firstItem' => $texts->firstItem(),
                'lastItem' => $texts->lastItem(),
                'hasPages' => $texts->hasPages(),
                'hasMorePages' => $texts->hasMorePages(),
                'path' => $texts->path(),
                'isEmpty' => $texts->isEmpty(),
                'isNotEmpty' => $texts->isNotEmpty(),
                'perPage' => $texts->perPage(),
                'currentPage' => $texts->currentPage(),
                'lastPage' => $texts->lastPage(),
            ],
        ]);
    }
}
