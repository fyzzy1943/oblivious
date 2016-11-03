<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/1
 * Time: 10:56
 */

namespace App\Helper;

use League\Uri\Schemes\Http as HttpUri;

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
        if (empty($part1)) {
            return $part2;
        }

        if (starts_with($part2, 'http')) {
            return $part2;
        }

        $uri1 = HttpUri::createFromString($part1);

        $part1 = $uri1->getScheme() . '://' . $uri1->getHost() . $uri1->getPath();

//        dd(hash('sha1', uniqid()));
        if (count($part2) == 0) {
            return $part1;
        }

        if ($part2[0] == '/') {
            return $uri1->getScheme() . '://' . $uri1->getHost() . $part2;
        }

        $part1 = rtrim($part1, '/') . '/';
        $part1 = strrev($part1);

        $part2 = ltrim($part2, '/');
//dd($part1);

        while (true) {
            if (starts_with($part2, './')) {
                $part2 = substr($part2, 2);
//                $part1 = substr($part1, strpos($part1, '/') + 1);
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

        return rtrim(strrev($part1), '/') . '/' . $part2;
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