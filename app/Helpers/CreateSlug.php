<?php

namespace App\Helpers;

class CreateSlug
{
    public static function create($string)
    {
        $string = strtolower($string);

        $string = preg_replace('/[^a-z0-9]+/', '-', $string);

        $string = trim($string, '-');

        return $string;
    }
}
