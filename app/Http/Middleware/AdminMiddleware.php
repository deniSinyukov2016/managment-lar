<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    const SESSION_KEY = 'message';
    const SESSION_MESSAGE = 'You are not admin!';

    public function handle($request, Closure $next)
    {
        if (!auth()->user()->isAdmin()) {
            session()->put(static::SESSION_KEY, static::SESSION_MESSAGE);

            return redirect()->route('projects.index');
        }

        return $next($request);
    }
}
