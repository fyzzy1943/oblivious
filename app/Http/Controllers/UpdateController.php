<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helper\url;
use App\Providers\IProvider;
use App\UpdateRule;
use Illuminate\Http\Request;

use App\Http\Requests;

class UpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('update.index')->with('rules', UpdateRule::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('update.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ur = new UpdateRule($request->all());
        $ur->save();

        return redirect('/update');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function makeArticle($serial = '*', url $helper)
    {
        echo $serial, '<br>';
        $rule = UpdateRule::where('serial', $serial)->first();
        $domain = $helper->getDomain($rule->url);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $rule->url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');

        $html = curl_exec($ch);

        preg_match($rule->url_area, $html, $match);
        preg_match_all($rule->url_rule, $match[1], $urls);

        $urls = array_map(function ($url) use ($helper, $rule) {
            return $helper->getFullUrl($rule->url, $url);
        }, $urls[1]);

        curl_setopt($ch, CURLOPT_URL, $urls[0]);
        $html = curl_exec($ch);

        preg_match($rule->content_area, $html, $match);

        preg_match($rule->title_rule, $match[1], $title);
        $title = trim($title[1]);
        preg_match($rule->date_rule, $match[1], $date);
        $date = '发布时间：' . trim($date[1]);
        preg_match($rule->article_rule, $match[1], $article);
        $article = $this->processArticle($article[1]);

//        foreach ($urls as $url) {
//
//        }

        curl_close($ch);
        dd($match[1], $title, $date, $article);

        dd($domain, $urls, $rule);
    }

    protected function processArticle($article)
    {
        $article = preg_replace('/<(style|script)[^>]*?>.*?<\/\1>/s', '', $article);

        return $article;
    }
}
