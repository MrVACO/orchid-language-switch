<?php

declare(strict_types = 1);

namespace MrVaco\OrchidLanguageSwitch\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
