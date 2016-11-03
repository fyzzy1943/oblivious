<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use App\Rule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class GetController extends Controller
{
    public function __construct()
    {
    }

    public function getArticles($serial, $num = 10)
    {
        $articles = Article::select('title', 'date', 'article')
            ->where(['serial'=>$serial, 'review'=>1])
            ->orderBy('id', 'desc')
            ->limit($num)
            ->get();

        Rule::increment('update_times');

        return count($articles) != 0 ? $articles->toJson() : 'null';
    }

    public function getImage($img)
    {
        $img = Image::select('path')->where('img', $img)->first();

        if ($img == null) {
            return 'null';
        }

        if ( ! Storage::exists($img->path)) {
            return 'not exists';
        }

        return redirect(url(Storage::url($img->path)));
    }

    public function getTitle($title, $isShadow)
    {
        $data = str_replace(array('-','_'),array('+','/'),$title);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        $title = base64_decode($data);

        $image = new \Imagick();
        $image->newImage(750, 50, new \ImagickPixel('#fff'));
        $image->setImageFormat('png');

        $icon = new \ImagickDraw();
        if ($isShadow=='true') {
            $icon->setFillColor(new \ImagickPixel('#800'));
        } else {
            $icon->setFillColor(new \ImagickPixel('#B00'));
        }
        $points = [
            ['x'=>3, 'y'=>18],
            ['x'=>19, 'y'=>25],
            ['x'=>3, 'y'=>32],
            ['x'=>7, 'y'=>25],
        ];
        $icon->polygon($points);
        $image->drawImage($icon);

        $text = new \ImagickDraw();
        $text->setFont('/home/wwwroot/fonts/chinese.msyh.ttf');
        $text->setFontSize(19);
        $text->setTextAntialias(true);
        if ($isShadow=='true') {
            $text->setFillColor(new \ImagickPixel('rgb(0, 0, 0)'));
            $image->annotateImage($text, 43, 33, 0, $title);
        } else {
            $text->setFillColor(new \ImagickPixel('rgb(23, 23, 23)'));
            $image->annotateImage($text, 42, 32, 0, $title);
        }

        $line = new \ImagickDraw();
        $line->setStrokeColor(new \ImagickPixel('rgb(217, 217, 217)'));
        for ($i=3; $i<=740; $i+=17) {
            $line->line($i, 48, $i+7, 48);
        }
        $image->drawImage($line);

        return response()->pngImage($image->getImageBlob());
    }
}
