<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        Request::macro('subdomain', function () {
            return current(explode('.', $this->getHost()));
        });


        if (($request->subdomain() === 'admin' || $request->route()->getPrefix() === '/admin') && ! $request->expectsJson()) {
            return route('admin.login.index');
        } else if (($request->subdomain() === 'adminsand' || $request->route()->getPrefix() === '/admin') && ! $request->expectsJson()) {
            return route('admin.login.index');
        } else if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
