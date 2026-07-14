<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\LocaleService;
use Illuminate\Support\Facades\Log;

class DetectLocale
{
    /**
     * Handle incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $country = $request->header('CF-IPCountry');

        $localeService = new LocaleService();


        $locale = $localeService->detect($country);


        app()->setLocale($locale);

        return $next($request);
    }
}
