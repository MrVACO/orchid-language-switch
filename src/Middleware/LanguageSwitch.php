<?php

declare(strict_types = 1);

namespace MrVaco\OrchidLanguageSwitch\Middleware;

use Cache;
use Illuminate\Http\Request;

class LanguageSwitch
{
    public function handle(Request $request, mixed $next): mixed
    {
        $lang = Cache::get(auth()->guard(config('platform.guard'))->id() . '.locale');

        if ($lang)
            app()->setLocale($lang);

        return $next($request);
    }
}
