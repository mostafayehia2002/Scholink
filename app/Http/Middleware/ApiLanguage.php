<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ApiLanguage
{

    public function handle(Request $request, Closure $next): Response
    {
        app()->setLocale('en');
        if($request->hasHeader("lang")) {
            App::setLocale($request->header("lang"));
        }
        return $next($request);
    }
}
