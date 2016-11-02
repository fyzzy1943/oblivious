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

if ( ! function_exists('get_username_by_uid')) {
    function get_username_by_uid($uid)
    {
        return App\User::select('nickname')->where('id', $uid)->first()->nickname;
    }
}
