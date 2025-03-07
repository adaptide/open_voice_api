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
            'text_id' => 'required|integer|exists:texts,id',
            'path' => 'required', // Max 10MB
        ]);
        dd($request->all());
        $text = Text::find($request->text_id);

        if (is_file($request->path)) {
            $filePath = $request->file('path')->store('recordings', 'public');
        }

        $text->recordings()->create([
            'path' => $filePath,
        ]);

        return response()->json(['message' => 'Recordings uploaded successfully'], Response::HTTP_CREATED);
    }
}
