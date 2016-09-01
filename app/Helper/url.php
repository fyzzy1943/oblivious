<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/1
 * Time: 10:56
 */

namespace App\Helper;


class url
{
    public function echo1()
    {
        echo 1;
    }

    public function getDomain($str)
    {
        preg_match('/\/*([^\/]+?\.[^\/]+?)\//', $str, $domain);
        return $domain[1];
    }

    public function getFullUrl($part1, $part2)
    {
        if ($part2[0] == '/') {
            return $this->getDomain($part1) . $part2;
        }

        $part1 = rtrim($part1, '/') . '/';

        while (true) {
            if (starts_with($part2, './')) {
                $part2 = substr($part2, 2);
                preg_match('/(.*)\//', $part1, $part1_temp);
                $part1 = $part1_temp[1];
            } else {
                break;
            }
        }

        return $part1 . '/' .$part2;
    }
}