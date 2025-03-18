<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class AssignUuidToUser
{

    public function handle(Request $request, Closure $next): Response
    {
        $uuid = $request->cookie('uuid');

        if (empty($uuid)) {
            $uuid = (string) Str::uuid();
            $request->cookies->set('uuid', $uuid);
        }

        $response = $next($request);
        $response->withCookie(cookie('uuid', $uuid, 60 * 24 * 365));

        return $response;
    }
}
