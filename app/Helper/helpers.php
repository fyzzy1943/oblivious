<?php

if ( ! function_exists('check_value')) {
    function check_value($role, $checks)
    {
        $check = explode('|', $checks);

        if (in_array($role, $check)) {
            return true;
        } else {
            return false;
        }
    }
}
