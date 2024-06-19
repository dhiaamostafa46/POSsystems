<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ShopAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        $requestUri = $_SERVER['REQUEST_URI'];
        // Parse the request URI to get just the path
        $path = parse_url($requestUri, PHP_URL_PATH);
        // Get the last part of the path
        $lastUrlPart = basename($path);
     
        return $request->expectsJson() ? null : route('Shop.login' ,$lastUrlPart);
    }


    protected function authenticate($request, array $guards)
    {



            if ($this->auth->guard('Shop')->check()) {
                return $this->auth->shouldUse('Shop');
            }


        $this->unauthenticated($request, ['Shop']);
    }
}
