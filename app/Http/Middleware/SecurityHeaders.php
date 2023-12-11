<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    private $unwantedHeaders = ['X-Powered-By', 'server', 'Server'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        $response->headers->set('Content-Security-Policy', config('var.BASE_URI'));
        $response->headers->set('Content-Security-Policy', config('var.DEFAULT_SRC'));
        $response->headers->set('Content-Security-Policy', config('var.SCRIPT_SRC'));
        $response->headers->set('Content-Security-Policy', config('var.STYLE_SRC'));
        $response->headers->set('Content-Security-Policy', config('var.IMG_SRC'));
        $response->headers->set('Content-Security-Policy', config('var.FONT_SRC'));
        $response->headers->set('Content-Security-Policy', config('var.FORM_ACTION'));
        $response->headers->set('Content-Security-Policy', config('var.FRAME_ANCESTORS'));
        $response->headers->set('Content-Security-Policy', config('var.CONNECT_SOURCE'));
        $response->headers->set('Expect-CT', 'enforce, max-age=30');
        $response->headers->set('Permissions-Policy', 'autoplay=(self), camera=(), encrypted-media=(self), fullscreen=(), geolocation=(self), gyroscope=(self), magnetometer=(), microphone=(), midi=(), payment=(), sync-xhr=(self), usb=()');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff ');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH,DELETE,OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type,Authorization,X-Requested-With,X-CSRF-Token');
        $this->removeUnwantedHeaders($this->unwantedHeaders);
        if (!app()->environment('testing')) {
        }

        return $response;
    }


    /**
     * @param $headers
     */
    private function removeUnwantedHeaders($headers): void
    {
        foreach ($headers as $header) {
            header_remove($header);
        }
    }
}
