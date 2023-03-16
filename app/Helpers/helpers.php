<?php

if (!function_exists('route_relative')) {
    function route_relative(string $route, array $parameters = [], ?bool $secure = null): string {
        preg_match("/{$_SERVER['HTTP_HOST']}(.+)/", route($route, $parameters, $secure), $match);

        return $match[1] ?? '/';
    }
}

if (!function_exists('webhook_url')) {
    function webhook_url() {
        return !empty(env('BOT_WEBHOOK_URL'))
            ? env('BOT_WEBHOOK_URL')
            : sprintf(
                '%s://%s%s',
                $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? $_SERVER['REQUEST_SCHEME'],
                $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['SERVER_NAME'],
                route_relative('bot')
            );
    }
}
