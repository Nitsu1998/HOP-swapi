<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateResourceType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $type = $request->route('type');

        if (in_array($type, ['vehicles', 'starships'])) {
            $model = $type === 'vehicles' ? Vehicle::class : Starship::class;
            $request->merge(['model' => $model]);
            return $next($request);
        }

        return response()->json(['error' => 'Invalid resource type'], 400);
    }
}
