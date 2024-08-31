<?php

namespace App\Helpers;

class PathHelper
{
    public static function getHostApi(): string
    {
        return env("APP_URL") . "/api";
    }
}
