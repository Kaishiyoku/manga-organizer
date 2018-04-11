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

if (! function_exists('generateHeadingLine')) {
    function generateHeadingLine($length, $char = '=')
    {
        return implode('', array_fill(0, $length, $char));
    }
}

if (! function_exists('generateAsciiHeading')) {
    function generateAsciiHeading($str, $char = '=')
    {
        return $str . "\n" . generateHeadingLine(strlen($str), $char);
    }
}

if (! function_exists('formatBool')) {
    function formatBool($bool)
    {
        return __('common.boolean.' . ($bool ? 'true' : 'false'));
    }
}

if (! function_exists('formatNumber')) {
    function formatNumber($number, $decimals = 0)
    {
        return number_format($number, $decimals, __('common.number.decimal_point'), __('common.number.thousands_seperator'));
    }
}
if (! function_exists('formatEmpty')) {
    function formatEmpty($str, $emptyStr = '/') {
        return $str ? $str : $emptyStr;
    }
}