<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Models\Text;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Filament\Facades\Filament;
class ApplyTenantScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Project::addGlobalScope(
        //     fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        // );
        // Text::addGlobalScope(
        //     fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        // );
        return $next($request);
    }
}
