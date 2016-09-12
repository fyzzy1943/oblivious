<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Helper\url;
use App\Image;
use App\Providers\IProvider;
use App\UpdateRule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

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
        header('X-Accel-Buffering: no');
        echo $serial, '<br>';

        $rule = UpdateRule::where('serial', $serial)->first();
        if ($rule == null) {
            return '此序列号不存在';
        }
        $domain = $helper->getDomain($rule->url);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $rule->url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');

        // 获取列表页面
        $html = curl_exec($ch);

        // 获取内容页面URL列表
        preg_match($rule->url_area, $html, $match);
        preg_match_all($rule->url_rule, $match[1], $urls);

        // 组合内容页面URL
        $urls = array_map(function ($url) use ($helper, $rule) {
            return $helper->getFullUrl($rule->url, $url);
        }, $urls[1]);

        foreach (array_reverse($urls) as $url) {
            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_URL, 'http://www.hljlr.gov.cn/hljgtzyt/xwdt/tndt/201609/t20160905_146597.htm');
//            curl_setopt($ch, CURLOPT_URL, 'http://www.hljlr.gov.cn/hljgtzyt/xwdt/tndt/201609/t20160906_146671.htm');
            $html = curl_exec($ch);

            // 获取内容区域
            preg_match($rule->content_area, $html, $match);

            // 获取标题
            preg_match($rule->title_rule, $match[1], $title);
            $title = trim($title[1]);

            if (Article::where('title', $title)->first() != null) {
                continue;
            }

            // 获取日期
            preg_match($rule->date_rule, $match[1], $date);
            $date = '发布时间：' . trim($date[1]);
            // 获取文章
            preg_match($rule->article_rule, $match[1], $article);
            $article = $this->processArticle($article[1], $images);

            // 得到图片数组
            $images = array_map(function ($image) use ($helper, $url) {
                return $helper->getFullImageUrl($url, $image);
            }, $images);

            // 下载图片
            foreach ($images as $key => $val) {
                curl_setopt($ch, CURLOPT_URL, $val);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_AUTOREFERER, false);
                curl_setopt($ch, CURLOPT_REFERER, $url);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $result = curl_exec($ch);
                $path = date("Ymd").'/'.$key;
                Storage::put($path, $result);

                $image = new Image();
                $image->img = $key;
                $image->path = $path;
                $image->save();
                var_dump($key);
            }

            $ar = new Article();
            $ar->serial = $serial;
            $ar->url = $url;
            $ar->title = $title;
            $ar->date = $date;
            $ar->article = $article;
            $ar->save();

            var_dump($title, '<br/>');
            @ob_flush(); @flush();

//            dd($title, $article, $images);
        }

        curl_close($ch);
//        dd($match[1], $title, $date, $article);

//        dd($domain, $urls, $rule);
    }

    protected function processArticle($article, &$images)
    {
        $images = array();

        $article = preg_replace('/\n/s', '', $article);
        $article = preg_replace('/&nbsp;/', ' ', $article);
        $article = str_replace('　', ' ', $article);

        // 去掉style和script标签
        $article = preg_replace('/<(style|script)[^>]*?>.*?<\/\1>/i', '', $article);

        // 处理换行
        $article = preg_replace('/(<\/p>|<\/div>|<\/h\d>)/i', '\1{BR}', $article);
        $article = preg_replace('/(<br.*?\/>|<br.*?>)/i', '\1{BR}', $article);

        // 匹配右对齐
        preg_match_all('/<(p|td|div)[^>]*?align[\s:"\'=]*?right[^>]*?>(.*?)<\/\1>/i',
            $article, $matches);
        foreach ($matches[2] as $match) {
            if (preg_match('/[\x{4E00}-\x{9FA5}]+/u', $match) > 0 &&
                    preg_match('/<img/', $match) == 0) {
                $article = str_replace($match, '{PAR}'.trim($match).'{/P}', $article);
            }
        }

        // 匹配中间对齐
        preg_match_all('/<(p|td|div)[^>]*?align[\s:"\'=]*?center[^>]*?>(.*?)<\/\1>/i',
            $article, $matches);
        foreach ($matches[2] as $match) {
            if (preg_match('/[\x{4E00}-\x{9FA5}]+/u', $match) > 0 &&
                preg_match('/<img/', $match) == 0) {
//                var_dump(htmlentities($match), trim($match));
                $article = str_replace($match, '{PAC}'.trim($match).'{/P}', $article);
            }
        }

        // 匹配左对齐
        preg_match_all('/<(p|td|div)[^>]*?align[\s:"\'=]*?left[^>]*?>(.*?)<\/\1>/i',
            $article, $matches);
        foreach ($matches[2] as $match) {
            if (preg_match('/[\x{4E00}-\x{9FA5}]+/u', $match) > 0 &&
                preg_match('/<img/', $match) == 0) {
                $article = str_replace($match, '{PAL}'.trim($match).'{/P}', $article);
            }
        }

        preg_match_all('/<img[^>]*?src[^>]*?>/i', $article, $matches);
        foreach ($matches[0] as $match) {
            preg_match('/\bsrc=["\']([^"^\']*?)["\']/i', $match, $tmp);
            $sha1 = hash('sha1', uniqid());
            $article = preg_replace('/'.preg_quote($match, '/').'/', '{IMG:'.$sha1.'}', $article);
            $images[$sha1] = $tmp[1];
        }

        // 去掉无用标签
        $article = preg_replace('/<.*?>/', '', $article);
        $article = preg_replace('/{PAC}\s*{\/P}/', '', $article);
        $article = preg_replace('/{PAR}\s*{\/P}/', '', $article);
        $article = preg_replace('/{PAL}\s*{\/P}/', '', $article);

        // 添加标签
        $article = preg_replace('/{PAC}\s*(.*?){\/P}/', '<p align="center">\1</p>', $article);
        $article = preg_replace('/{PAR}\s*(.*?){\/P}/', '<p align="right">\1</p>', $article);
        $article = preg_replace('/{PAL}\s*(.*?){\/P}/', '<p align="left">\1</p>', $article);

        $article = preg_replace('/{(PAC|PAR|PAL|\/P)}/', '', $article);

        $lines = explode('{BR}', $article);
        $article = '';
        $align = false;

//        dd($lines);

        foreach ($lines as $line) {
            $line = trim($line);
            if ( ! $line == '') {
                if (str_contains($line, '<p align')) {
                    $align = true;
                }
                if (starts_with($line, '<')) {
                    $article .= $line . '\r\n';
                } else {
                    if ($align) {
                        $article .= $line . '\r\n';
                    } else {
                        $article .= '　　' . $line . '\r\n';
                    }
                }
                if (str_contains($line, '</p>')) {
                    $align = false;
                }
            }
        }

//        dd($article);
        $article .= '\r\n\r\n\r\n\r\n\r\n\r\n\r\n';

//        $article = htmlspecialchars_decode($article);

        return $article;
    }
}
