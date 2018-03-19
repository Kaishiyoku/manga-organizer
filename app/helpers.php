<?php

use Illuminate\Database\QueryException;

if (! function_exists('handleIntegrityConstraintViolation')) {
    function handleIntegrityConstraintViolation($message, Closure $closure)
    {
        try {
            $closure();
        } catch (QueryException $e) {
            if ($e->errorInfo[0] == 23000) {
                flash($message)->error();
            }
        }
    }
}

if (! function_exists('generateAsciiHeading')) {
    function generateAsciiHeading($str)
    {
        //$asciiContent =

        return '#';
    }
}

if (! function_exists('formatBool')) {
    function formatBool($bool)
    {
        return __('common.boolean.' . ($bool ? 'true' : 'false'));
    }
}