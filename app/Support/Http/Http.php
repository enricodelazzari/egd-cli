<?php

namespace App\Support\Http;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http as LaravelHttp;
use Illuminate\Support\Str;

abstract class Http
{
    protected function baseUrl(): string
    {
        return config('egd.base_url');
    }

    protected function send(array $options = []): Response
    {
        return LaravelHttp::send(
            $this->getMethod(),
            $this->endpoint(),
            $options
        );
    }

    protected function route(): string
    {
        return '';
    }

    protected function getMethod(): string
    {
        return defined('static::METHOD') ? static::METHOD : 'post';
    }

    private function endpoint(): string
    {
        $url = rtrim($this->baseUrl(), '/');
        $route = ltrim($this->route(), '/');

        return Str::of($url)
            ->finish('/')
            ->append($route)
            ->__toString();
    }
}
