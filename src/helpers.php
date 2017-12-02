<?php

use ElfSundae\Laravel\Apps\AppIdentifier;

if (! function_exists('app_id')) {
    /**
     * Get or check the current application identifier.
     *
     * @return string|bool
     */
    function app_id()
    {
        $identifier = AppIdentifier::get();

        if (func_num_args() > 0) {
            return in_array($identifier, is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args());
        }

        return $identifier;
    }
}

if (! function_exists('app_url')) {
    /**
     * Generate an absolute URL to the given path.
     *
     * @param  string  $path
     * @param  mixed  $query
     * @param  mixed  $identifier
     * @return string
     */
    function app_url($path = '', $query = [], $identifier = '')
    {
        if (is_string($query)) {
            list($query, $identifier) = [$identifier, $query];
        }

        $url = config("apps.url.$identifier", config('app.url'));

        if ($path = ltrim($path, '/')) {
            $url .= (strpos($path, '?') === 0 ? '' : '/').$path;
        }

        if ($query && $query = http_build_query($query, '', '&', PHP_QUERY_RFC3986)) {
            $url .= (strpos($url, '?') === false ? '?' : '&').$query;
        }

        return $url;
    }
}
