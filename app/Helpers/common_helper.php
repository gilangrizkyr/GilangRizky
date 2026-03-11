<?php

/**
 * Helper: safely read array/object field
 * 
 * @param array|object|null $obj
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
if (!function_exists('field')) {
    function field($obj, $key, $default = '')
    {
        if (is_array($obj)) {
            return $obj[$key] ?? $default;
        }
        if (is_object($obj)) {
            return $obj->$key ?? $default;
        }
        return $default;
    }
}
