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

    //
    public function getFullUrl($base, $rel)
    {
        $pbase = parse_url($base);
        $prel = parse_url($rel);

        $merged = array_merge($pbase, $prel);
        if ($prel['path'][0] != '/') {
            // Relative path
            $dir = preg_replace('@/[^/]*$@', '', $pbase['path']);
            $merged['path'] = $dir . '/' . $prel['path'];
        }

        // Get the path components, and remove the initial empty one
        $pathParts = explode('/', $merged['path']);
        array_shift($pathParts);

        $path = [];
        $prevPart = '';
        foreach ($pathParts as $part) {
            if ($part == '..' && count($path) > 0) {
                // Cancel out the parent directory (if there's a parent to cancel)
                $parent = array_pop($path);
                // But if it was also a parent directory, leave it in
                if ($parent == '..') {
                    array_push($path, $parent);
                    array_push($path, $part);
                }
            } else if ($prevPart != '' || ($part != '.' && $part != '')) {
                // Don't include empty or current-directory components
                if ($part == '.') {
                    $part = '';
                }
                array_push($path, $part);
            }
            $prevPart = $part;
        }
        $merged['path'] = '/' . implode('/', $path);

        $ret = '';
        if (isset($merged['scheme'])) {
            $ret .= $merged['scheme'] . ':';
        }

        if (isset($merged['scheme']) || isset($merged['host'])) {
            $ret .= '//';
        }

        if (isset($prel['host'])) {
            $hostSource = $prel;
        } else {
            $hostSource = $pbase;
        }

        // username, password, and port are associated with the hostname, not merged
        if (isset($hostSource['host'])) {
            if (isset($hostSource['user'])) {
                $ret .= $hostSource['user'];
                if (isset($hostSource['pass'])) {
                    $ret .= ':' . $hostSource['pass'];
                }
                $ret .= '@';
            }
            $ret .= $hostSource['host'];
            if (isset($hostSource['port'])) {
                $ret .= ':' . $hostSource['port'];
            }
        }

        if (isset($merged['path'])) {
            $ret .= $merged['path'];
        }

        if (isset($prel['query'])) {
            $ret .= '?' . $prel['query'];
        }

        if (isset($prel['fragment'])) {
            $ret .= '#' . $prel['fragment'];
        }

        return $ret;
    }

//    public function getFullUrl($part1, $part2)
//    {
//        if (empty($part1)) {
//            return $part2;
//        }
//
//        if (starts_with($part2, 'http')) {
//            return $part2;
//        }
//
//        preg_match('/.*\//i', $part1, $temp);
//        $part1 = $temp[0];
//
//        $uri1 = HttpUri::createFromString($part1);
//        $uri2 = HttpUri::createFromString($part2);
//        $uri1->path->append($part2);
//
//        dd($uri1);
//
//        $part1 = $uri1->getScheme() . '://' . $uri1->getHost() . $uri1->getPath();
//
////        dd($part1);
//
////        dd(hash('sha1', uniqid()));
//        if (count($part2) == 0) {
//            return $part1;
//        }
//
//        if ($part2[0] == '/') {
//            return $uri1->getScheme() . '://' . $uri1->getHost() . $part2;
//        }
//
//        $part1 = rtrim($part1, '/') . '/';
//        $part1 = strrev($part1);
//
//        $part2 = ltrim($part2, '/');
////dd($part1);
//
//        while (true) {
//            if (starts_with($part2, './')) {
//                $part2 = substr($part2, 2);
////                $part1 = substr($part1, strpos($part1, '/') + 1);
//            } else if (starts_with($part2, '../')) {
//                if (starts_with($part1, '/')) {
//                    $part1 = substr($part1, strpos($part1, '/') + 1);
//                }
//
//                $part2 = substr($part2, 3);
//                $part1 = substr($part1, strpos($part1, '/') + 1);
//            } else {
//                break;
//            }
//        }
//
//        return rtrim(strrev($part1), '/') . '/' . $part2;
//    }

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