<?php

namespace App\Http\Controllers;

use App\Http\Resources\TextResource;
use App\Models\Recording;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class TextController
{
    public function __invoke(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        $userId = $user?->id;
        $uuid = $request->cookie('uuid');

        $recordedTextIds = Recording::query()
            ->when($userId, fn($query) => $query->orWhere('user_id', $userId))
            ->when($uuid, fn($query) => $query->orWhere('uuid', $uuid))
            ->pluck('text_id')
            ->toArray();

        $textsQuery = Text::with(['project', 'category'])
            ->when(
                $request->has('organization'),
                function ($query) use ($request, $user) {
                    if (!$user || !$user->organizations()->where('id', $request->organization)->exists()) {
                        return $query->whereRaw('1 = 0');
                    }
                    return $query->whereHas('project', fn($q) => $q->where('organization_id', $request->organization));
                },
                function ($query) {
                    $query->whereIsPublic(true);
                }
            )
            ->whereNotIn('id', $recordedTextIds)
            ->inRandomOrder()
            ->limit($request->input('count', 1));

        $texts = $textsQuery->get();
        if ($texts->isEmpty()) {
            return response()->json([
                'message' => 'Нет доступных текстов для записи.',
                'data' => [],
            ], 404);
        }
        return response()->json([
            'data' => TextResource::collection($texts),
        ]);
    }
}
