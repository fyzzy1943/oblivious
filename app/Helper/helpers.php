<?php

if ( ! function_exists('check_value')) {
    function check_value($value, $checks)
    {
        $check = explode('|', $checks);

        if (in_array($value, $check)) {
            return true;
        } else {
            return false;
        }
    }
}
