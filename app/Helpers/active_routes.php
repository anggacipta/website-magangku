<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('active_route')) {
    function active_route($route, $output = 'active')
    {
        return Route::currentRouteName() == $route ? $output : '';
    }
}
