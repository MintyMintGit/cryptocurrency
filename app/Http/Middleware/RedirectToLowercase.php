<?php

namespace App\Http\Middleware;


class RedirectToLowercase
{
    public function handle($request, \Closure $next) {
        $path = $request->path();
        $pathLowercase = strtolower($path); // convert to lowercase

        if ($path !== $pathLowercase) {
            // redirect if lowercased path differs from original path
            return redirect($pathLowercase);
        }

        return $next($request);
    }
}