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
        echo $serial, '<pre>';
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

        foreach (array_reverse($urls) as $url) {
            curl_setopt($ch, CURLOPT_URL, $url);
            $html = curl_exec($ch);

            preg_match($rule->content_area, $html, $match);

            var_dump($url);
            preg_match($rule->title_rule, $match[1], $title);
            $title = trim($title[1]);
            preg_match($rule->date_rule, $match[1], $date);
            $date = '发布时间：' . trim($date[1]);
            preg_match($rule->article_rule, $match[1], $article);
            $article = $this->processArticle($article[1]);

            var_dump($title, $article);
        }

        curl_close($ch);
//        dd($match[1], $title, $date, $article);

        dd($domain, $urls, $rule);
    }

    protected function processArticle($article)
    {
        $article = preg_replace('/\n/s', '', $article);
        $article = preg_replace('/&nbsp;/', ' ', $article);

        $article = preg_replace('/<(style|script)[^>]*?>.*?<\/\1>/i', '', $article);

        // 处理换行
        $article = preg_replace('/(<\/p>|<\/div>|<\/h\d>)/i', '\1{BR}', $article);
        $article = preg_replace('/(<br\s*\/>|<br\s*>)/i', '\1{BR}', $article);

        // 匹配右对齐
        preg_match_all('/<(p|td|div)[^>]*?align[\s:"\'=]*?right[^>]*?>(.*?)<\/\1>/i',
            $article, $matches);
        foreach ($matches[2] as $match) {
            if (preg_match('/[\x{4E00}-\x{9FA5}]+/u', $match) > 0 &&
                    preg_match('/<img/', $match) == 0) {
                $article = str_replace($article, $match, '{PAR}'.trim($match).'{/P}');
            }
        }

        // 匹配中间对齐
        preg_match_all('/<(p|td|div)[^>]*?align[\s:"\'=]*?center[^>]*?>(.*?)<\/\1>/i',
            $article, $matches);
        foreach ($matches[2] as $match) {
            if (preg_match('/[\x{4E00}-\x{9FA5}]+/u', $match) > 0 &&
                preg_match('/<img/', $match) == 0) {
                $article = str_replace($article, $match, '{PAC}'.trim($match).'{/P}');
            }
        }

        // 匹配左对齐
        preg_match_all('/<(p|td|div)[^>]*?align[\s:"\'=]*?left[^>]*?>(.*?)<\/\1>/i',
            $article, $matches);
        foreach ($matches[2] as $match) {
            if (preg_match('/[\x{4E00}-\x{9FA5}]+/u', $match) > 0 &&
                preg_match('/<img/', $match) == 0) {
                $article = str_replace($article, $match, '{PAL}'.trim($match).'{/P}');
            }
        }



        return $article;
    }
}
