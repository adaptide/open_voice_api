<?php

namespace App\Http\Controllers;

use App\Models\Text;


final class TextController
{
    public function __invoke()
    {
        return response()->json([
            'text' => Text::get()
        ]);
    }
}
