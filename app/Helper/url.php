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
//        dd(hash('sha1', uniqid()));
        if ($part2[0] == '/') {
            return $this->getDomain($part1) . $part2;
        }

        $part1 = rtrim($part1, '/') . '/';
        $part1 = strrev($part1);

        while (true) {
            if (starts_with($part2, './')) {
                $part2 = substr($part2, 2);
                $part1 = substr($part1, strpos($part1, '/') + 1);
            } else if (starts_with($part2, '../')) {
                if (starts_with($part1, '/')) {
                    $part1 = substr($part1, strpos($part1, '/') + 1);
                }

                $part2 = substr($part2, 3);
                $part1 = substr($part1, strpos($part1, '/') + 1);
            } else {
                break;
            }
        }

        return strrev($part1) . '/' .$part2;
    }

    public function getFullImageUrl($part1, $part2)
    {
        preg_match('/\S*\//', $part1, $temp);
        $part1 = $temp[0];

        if ($part2[0] == '/') {
            return $this->getDomain($part1) . $part2;
        }

        $part1 = rtrim($part1, '/') . '/';
        $part1 = strrev($part1);

        while (true) {
            if (starts_with($part2, './')) {
                $part2 = substr($part2, 2);
                $part1 = substr($part1, strpos($part1, '/') + 1);
            } else if (starts_with($part2, '../')) {
                if (starts_with($part1, '/')) {
                    $part1 = substr($part1, strpos($part1, '/') + 1);
                }

                $part2 = substr($part2, 3);
                $part1 = substr($part1, strpos($part1, '/') + 1);
            } else {
                break;
            }
        }

        return strrev($part1) . '/' .$part2;
    }
}