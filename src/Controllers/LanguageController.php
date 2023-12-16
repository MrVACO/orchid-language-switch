<?php

declare(strict_types = 1);

namespace MrVaco\OrchidLanguageSwitch\Controllers;

use Cache;
use Illuminate\Http\RedirectResponse;
use Orchid\Support\Facades\Toast;

class LanguageController
{
    public function __invoke(string $lang): RedirectResponse
    {
        $languages = config('orchid-language-switch.languages');

        if (!array_key_exists($lang, $languages))
        {
            Toast::error(__('Localization not found'));

            return redirect()->back();
        }

        $key = auth()->guard(config('platform.guard'))->id() . '.locale';
        Cache::forever($key, $lang);
        app()->setLocale($lang);

        Toast::success(__('Localization changed'));

        return redirect()->back();
    }

}
