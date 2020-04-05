<?php
if (file_exists('../.env')) {
    $env = file_get_contents('../.env');
    $variables = explode(PHP_EOL, $env);
    foreach ($variables as $value) {
        putenv("$value");
    }
}


if (!function_exists('config')) {
    /**
     * Gets the value of an config variables.
     *
     * @param $path
     * @return mixed
     */
    function config($path)
    {
        $path_arr = explode('.', $path);
        if ($path_arr[0] && $path_arr[1] && file_exists(__DIR__ . '/../app/config/' . $path_arr[0] . '.php')) {
            $config = require __DIR__ . '/../app/config/' . $path_arr[0] . '.php';
            $path_count = count($path_arr);
            $cur_arr = $config;

            for ($i = 1; $i <= $path_count; $i++) {
                if ($i === $path_count && empty($path_arr[$i])) {
                    return $cur_arr;
                }

                $cur_arr = $cur_arr[$path_arr[$i]];
            }
        }
        return false;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return getenv($key) ?? $default;
    }
}

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

if (!function_exists('response')) {
    /**
     * Return a new response from the application.
     *
     */
    function response($content = '', $status = 200, array $headers = [])
    {
        return new App\Core\Response();
    }
}

if (!function_exists('toArray')) {
    function toArray($objects)
    {
        return json_decode(json_encode($objects), true);
    }
}

if (!function_exists('isApi')) {
    function isApi(): bool
    {
        return $_SERVER['HTTP_ACCEPT'] === 'application/json';
    }
}

function isJson($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

if (!function_exists('redirect')) {
    /**
     * Redirect
     *
     */
    function redirect(string $page)
    {
        $root = getenv('APP_URL') ?? null;

        header("Location: " . $root . $page);
        exit();
    }
}
