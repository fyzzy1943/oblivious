<?php

namespace App\Http\Controllers;

use App\Article;
use App\Helper\url;
use App\Image;
use App\Rule;
use App\UpdateRule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    protected $ch_html;
    protected $ch_img;
    protected $url_helper;

    public function __construct()
    {
        $this->url_helper = new url();
        $this->ch_html = curl_init();
        $this->ch_img = curl_init();

        curl_setopt($this->ch_html, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch_html, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');

        curl_setopt($this->ch_img, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36');
        curl_setopt($this->ch_img, CURLOPT_VERBOSE, 1);
        curl_setopt($this->ch_img, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch_img, CURLOPT_AUTOREFERER, false);
        curl_setopt($this->ch_img, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($this->ch_img, CURLOPT_HEADER, 0);
    }

    public function __destruct()
    {
        curl_close($this->ch_img);
        curl_close($this->ch_html);
    }

    public function update(Requests\UpdateRequest $request, $serial = '*')
    {
        set_time_limit(0);
        header('X-Accel-Buffering: no');

        if ($serial == '*') {

        } else {
            $this->updateArticle(Rule::where('serial', $serial)->first());
        }
    }

    protected function updateArticle(Rule $rule)
    {
        $rule->increment('regex_times');

        $this->echoLine('<pre>开始更新【'.$rule->first.'-'.$rule->second.'】');
        curl_setopt($this->ch_html, CURLOPT_URL, $rule->list_url);

        // 获取列表页面
        $html = curl_exec($this->ch_html);
        $html = mb_convert_encoding($html, 'utf-8', 'GBK, UTF-8, ASCII');

        // 获取内容页面URL列表
        preg_match($rule->regex_url_area, $html, $match);
        preg_match_all($rule->regex_url_list, $match[1], $urls);

        // 组合内容页面URL
        $urls = array_map(function ($url) use ($rule) {
            return $this->url_helper->getFullUrl($rule->list_url, $url);
        }, $urls[1]);
        $this->echoLine('文章url组合完毕, 本次预计更新【' . count($urls) . '】条');

        // 更新文章
        foreach (array_reverse($urls) as $url) {
//            $url = 'http://www.hljlr.gov.cn/hljgtzyt/xwdt/tndt/201609/t20160905_146597.htm';
            curl_setopt($this->ch_html, CURLOPT_URL, $url);
            $html = curl_exec($this->ch_html);
            $html = mb_convert_encoding($html, 'utf-8', 'GBK, UTF-8, ASCII');

            $this->echoLine('当前更新：【<a href="'.$url.'" target="_blank">'.$url.'</a>】');

            // 获取内容区域
            foreach (explode(PHP_EOL, $rule->regex_article) as $regex) {
                if (1==preg_match(trim($regex), $html, $match)) {
                    break;
                }
            }

//            dd($rule->content_area, $url, $html, $match);

            // 获取标题
            foreach (explode(PHP_EOL, $rule->regex_title) as $regex) {
                if (1==preg_match(trim($regex), $match[1], $title)) {
                    break;
                }
            }
            $title = trim($title[1]);

            if (Article::where(['title'=>$title, 'serial'=>$rule->serial])->exists()) {
                $this->echoLine('【' . $title . '】已经存在，自动略过');
                continue;
            }

            $this->echoLine('开始更新【' . $title . '】');

            // 获取日期
            foreach (explode(PHP_EOL, $rule->regex_date) as $regex) {
                if (1==preg_match(trim($regex), $match[1], $date)) {
                    break;
                }
            }
            $date = '发布时间：' . trim($date[1]);

            // 获取文章
            foreach (explode(PHP_EOL, $rule->regex_text) as $regex) {
                if (1==preg_match(trim($regex), $match[1], $text)) {
                    break;
                }
            }

            $html_text = $this->processToHtmlText($text[1], $images);
            $update_text = $this->processArticle($html_text);

//            echo $html_text;
//            dd($html_text, $text[1]);

            // 得到图片数组
            $images = array_map(function ($image) use ($url) {
                return $this->url_helper->getFullImageUrl($url, $image);
            }, $images);

            // 下载图片
            if (count($images) > 0) {
                $this->echoLine('本篇文章存在【'.count($images).'】图片，开始下载');

                foreach ($images as $key => $val) {
                    curl_setopt($this->ch_img, CURLOPT_URL, $val);
                    curl_setopt($this->ch_img, CURLOPT_REFERER, $url);
                    $result = curl_exec($this->ch_img);
                    $path = date("Ymd").'/'.$key;
                    Storage::put($path, $result);

                    $image = new Image();
                    $image->img = $key;
                    $image->path = $path;
                    $image->save();

                    $this->echoLine('图片' . $key . '下载完成');
                }
            }

            $ar = new Article();
            $ar->serial = $rule->serial;
            $ar->url = $url;
            $ar->title = $title;
            $ar->date = $date;
            $ar->article = $update_text;
            $ar->html_text = $html_text;
            $ar->save();
        }

        $this->echoLine('专栏【' . $rule->serial . '】更新完成');
    }

    protected function processArticle($article)
    {
        // 处理换行
        $article = preg_replace('/(<\/p>|<\/div>|<\/h\d>)/i', '\1{{br}}', $article);
        $article = preg_replace('/(<br.*?\/>|<br.*?>)/i', '\1{{br}}', $article);

        // 去掉无用标签
        $article = preg_replace('/<.*?>/', '', $article);

        $lines = explode('{{br}}', $article);
        $article = '';
        $align = false;

        foreach ($lines as $line) {
            $line = trim($line);
            if ( ! $line == '') {
                if (str_contains($line, '<p align')) {
                    $align = true;
                }
                if (starts_with($line, '<')) {
                    $article .= $line . PHP_EOL;
                } else {
                    if ($align) {
                        $article .= $line . PHP_EOL;
                    } else {
                        $article .= '　　' . $line . PHP_EOL;
                    }
                }
                if (str_contains($line, '</p>')) {
                    $align = false;
                }
            }
        }

        $article = str_replace('{{', '<', $article);
        $article = str_replace('}}', '>', $article);

        $article .= PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL;

        return $article;
    }

    protected function processToHtmlText($text, &$images)
    {
        $images = [];

        $text = preg_replace('/\n|\r|\r\n/s', '', $text);
        $text = preg_replace('/&nbsp;/', ' ', $text);
        $text = str_replace('　', ' ', $text);

//        dd($text);

        // 去掉style和script标签<!--
        $text = preg_replace('/<(style|script)[^>]*?>.*?<\/\1>/i', '', $text);
        $text = preg_replace('/<!--.*?-->/i', '', $text);

        $text = preg_replace('/<!--.*?-->/i', '', $text);
//        $text = preg_replace('/<[]>/i', '', $text);

        // 处理图片
        preg_match_all('/<img[^>]*?src[^>]*?>/i', $text, $matches);
        foreach ($matches[0] as $match) {
            preg_match('/\bsrc=["\']([^"^\']*?)["\']/i', $match, $tmp);
            $key = hash('sha1', uniqid());
//            $text = preg_replace('/'.preg_quote($match, '/').'/', '<img src="'.$key.'">', $text);
            $text = str_replace($match, '{{img src="'.$key.'"}}', $text);
            $images[$key] = $tmp[1];
        }

        $text = preg_replace('/<([a-z]+?)\s*[^>]*?\balign[^>]*?(left|right|center)[^>]*?>(.*?)<\/\1>/i', '{{\1 align="\2"}}\3{{/\1}}', $text);

//        dd($text);
        return $text;
    }

    protected function echoLine($str)
    {
        echo $str, PHP_EOL;
        @ob_flush(); @flush();
    }
}
