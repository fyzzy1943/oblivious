<?php

namespace App\Http\Controllers;

use App\Helper\url;
use Illuminate\Http\Request;

use App\Http\Requests;

class HelperController extends Controller
{
    public function showListRegexForm()
    {
        return view('helper.listRegexTest');
    }

    public function testListRegex(Request $request, url $helper)
    {
        $request->flash();

        $url = $request->input('url');
        $html = $request->input('html');
        $area_regex = $request->input('area_regex');
        $list_regex = $request->input('list_regex');

        if (empty($url)) {
            return view('helper.listRegexTest')->withErrors('请输入url');
        }

        if (empty($html)) {
            return view('helper.listRegexTest')->withErrors('请输入源代码');
        }

        if (empty($area_regex)) {
            return view('helper.listRegexTest')->with('result', $html);
        }

        preg_match($area_regex, $html, $result);
        $html = $result[1] ?? '';
        if (empty($html)) {
            return view('helper.listRegexTest')->withErrors('区域无匹配');
        }

        if (empty($list_regex)) {
            return view('helper.listRegexTest')->with('result', $html);
        }

        preg_match_all($list_regex, $html, $result);

        $html = $result[1] ?? '';
        if (empty($html)) {
            return view('helper.listRegexTest')->withErrors('列表无匹配');
        }

        $html = array_map(function ($item) use ($helper, $url) {
            return $helper->getFullUrl($url, $item);
        }, $html);

        $html = implode(PHP_EOL, $html);

        return view('helper.listRegexTest')->with('result', $html);
    }

    public function showArticleRegexForm()
    {
        return view('helper.articleRegexTest');
    }

    public function testArticleRegex(Request $request)
    {
        $request->flash();

        $html = $request->input('html');
        $area_regex = $request->input('area_regex');
        $title_regex = $request->input('title_regex');
        $date_regex = $request->input('date_regex');
        $text_regex = $request->input('text_regex');

        if (empty($html)) {
            return view('helper.articleRegexTest')->withErrors('请输入源代码');
        }

        if (empty($area_regex)) {
            return view('helper.articleRegexTest')->with('result', $html);
        }
        preg_match($area_regex, $html, $result);
        $area = $result[1] ?? '';
        if (empty($html)) {
            return view('helper.articleRegexTest')->withErrors('区域无匹配');
        }

        if (empty($title_regex)) {
            return view('helper.articleRegexTest')->with('result', trim($area));
        }
        preg_match($title_regex, $area, $result);
        $html = $result[1] ?? '';
        if (empty($html)) {
            return view('helper.articleRegexTest')->withErrors('标题无匹配');
        }

        if (empty($date_regex)) {
            return view('helper.articleRegexTest')->with('result', trim($html));
        }
        preg_match($date_regex, $area, $result);
        $html = $result[1] ?? '';
        if (empty($html)) {
            return view('helper.articleRegexTest')->withErrors('日期无匹配');
        }

        if (empty($text_regex)) {
            return view('helper.articleRegexTest')->with('result', '发布时间：' . trim($html));
        }
        preg_match($text_regex, $area, $result);
        $html = $result[1] ?? '';
        if (empty($html)) {
            return view('helper.articleRegexTest')->withErrors('正文无匹配');
        }

        return view('helper.articleRegexTest')->with('result', $html);
    }
}
