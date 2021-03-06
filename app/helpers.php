<?php

use Illuminate\Support\Str;
    function route_class()
    {
        return str_replace('.','-',Route::currentRouteName());
    }

    function make_excerpt($value,$length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return Str::limit($excerpt,$length);
    }
