<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class HelperController extends Controller
{
    public function showListRegexForm()
    {
        return view('helper.listRegexTest');
    }

    public function testListRegex(Request $request)
    {
        $request->flash();

        $html = $request->input('html');
        $area_regex = $request->input('area_regex');
        $list_regex = $request->input('list_regex');

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

        $html = implode(PHP_EOL, $html);
//        dd($html);

        return view('helper.listRegexTest')->with('result', $html);
    }
}
