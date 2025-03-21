<?php

namespace App\Http\Controllers;

use App\Models\Recording;
use App\Models\Review;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final class RecordingController
{
    public function store(Request $request)
    {
        $request->validate([
            'text_id' => 'required|integer|exists:texts,id',
            'path' => 'required', // Max 10MB
        ]);

        $text = Text::with(['project.organization'])->findOrFail($request->text_id);
        $userName = Auth::guard('sanctum')->check() ? Auth::guard('sanctum')->user()->name : request()->cookie('uuid');
        $organization = str_replace(' ', '_', $text->project->organization->name);
        $project = str_replace(' ', '_', $text->project->name);
        $user = str_replace(' ', '_', $userName);
        $textName = str_replace(' ', '_', $text->content);

        $extension = $request->file('path')->getClientOriginalExtension();

        $directory = "{$organization}/{$project}/{$user}";
        Storage::disk('public')->makeDirectory($directory);

        $audioFileName = "{$textName}.{$extension}";
        $textFileName = "{$textName}.txt";

        $audioFilePath = "{$directory}/{$audioFileName}";
        Storage::disk('public')->putFileAs($directory, $request->file('path'), $audioFileName);

        Storage::disk('public')->put("{$directory}/{$textFileName}", $text->content);

        $text->recordings()->create([
            'path' => $audioFilePath,
        ]);

        return response()->json(['message' => 'Recordings uploaded successfully'], Response::HTTP_CREATED);
    }
    public function index()
    {
        $recordings = Recording::with('text')->get();

        $recordings->map(function ($recording) {
            $recording->full_path = Storage::disk('public')->url($recording->path);
            return $recording;
        });

        return response()->json($recordings);
    }

    // app/Http/Controllers/RecordingController.php

    public function review(Request $request)
    {
        $request->validate([
            'recording_id' => 'required|integer|exists:recordings,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
        ]);

        $review = Review::create([
            'recording_id' => $request->recording_id,
            'user_id' => Auth::id(),
            'uuid' => $request->uuid ?? (string) \Str::uuid(),
            'feedback' => $request->feedback,
            'rating' => $request->rating,
        ]);

        return response()->json(['message' => 'Review submitted successfully', 'review' => $review], \Response::HTTP_CREATED);
    }
}
