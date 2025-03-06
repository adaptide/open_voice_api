<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RecordingController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'recordings' => 'required|array',
            'recordings.*.text_id' => 'required|integer|exists:texts,id',
            'recordings.*.path' => 'required|file|mimes:mp3|max:10240', // Max 10MB
        ]);

        foreach ($request->recordings as $recording) {
            $text = Text::find($recording['text_id']);

            if (is_file($recording['path'])) {
                $filePath = $recording['path']->store('recordings', 'public');
            }

            $text->recordings()->create([
                'path' => $filePath,
            ]);
        }

        return response()->json(['message' => 'Recordings uploaded successfully'], Response::HTTP_CREATED);
    }
}
