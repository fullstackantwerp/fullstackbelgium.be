<?php

namespace App\Http;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\BaseCacheProfile;
use Symfony\Component\HttpFoundation\Response;

class CacheProfile extends BaseCacheProfile
{
    public function shouldCacheRequest(Request $request): bool
    {
        if (Str::contains($request->url(), ['nova'])) {
            return false;
        }

        if ($request->ajax()) {
            return false;
        }

        if ($this->isRunningInConsole()) {
            return false;
        }

        return $request->isMethod('get');
    }

    public function shouldCacheResponse(Response $response): bool
    {
        if (! $this->hasCacheableResponseCode($response)) {
            return false;
        }

        if (! $this->hasCacheableContentType($response)) {
            return false;
        }

        return true;
    }

    public function hasCacheableResponseCode(Response $response): bool
    {
        if ($response->isSuccessful()) {
            return true;
        }

        if ($response->isRedirection()) {
            return true;
        }

        return false;
    }

    public function hasCacheableContentType(Response $response)
    {
        $contentType = $response->headers->get('Content-Type', '');

        return Str::startsWith($contentType, 'text');
    }
}
