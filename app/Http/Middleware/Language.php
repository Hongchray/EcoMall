<?php

namespace App\Http\Middleware;

use App;
use App\Models\Language as LanguageModel;
use Config;
use Closure;
use Cookie;
use Session;
use Carbon\Carbon;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->filled('lang')){
            $language = LanguageModel::where('code', $request->lang)
                ->where('status', 1)
                ->first();

            if($language != null){
                $locale = $language->code;
                $request->session()->put('locale', $language->code);
                $request->session()->put('langcode', $language->app_lang_code);
                Cookie::queue('locale', $language->code, 60 * 24 * 30);
                Cookie::queue('langcode', $language->app_lang_code, 60 * 24 * 30);
            }
        }

        if(!isset($locale) && Session::has('locale')){
            $locale = Session::get('locale');
        }
        elseif(!isset($locale) && $request->hasCookie('locale')){
            $locale = $request->cookie('locale');
        }
        elseif(!isset($locale)){
            $locale = env('DEFAULT_LANGUAGE','en');
        }

        App::setLocale($locale);
        $request->session()->put('locale', $locale);

        $langcode = Session::has('langcode') ? Session::get('langcode') : $request->cookie('langcode', 'en');
        Carbon::setLocale($langcode);

        return $next($request);
    }
}
