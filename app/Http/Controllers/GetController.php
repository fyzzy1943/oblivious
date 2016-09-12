<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class GetController extends Controller
{
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

    public function getArticle($serial, $num = 10)
    {
        $articles = Article::select('title', 'date', 'article')
            ->where('serial', $serial)
            ->orderBy('id', 'desc')
            ->limit($num)
            ->get();

        return count($articles) != 0 ? $articles->toJson() : 'null';
    }

    public function getTitle($title)
    {
        $image = new \Imagick();
        $draw = new \ImagickDraw();
        $pixel = new \ImagickPixel('white');
        $image->newImage(750, 50, $pixel);
        $pixel->setColor('rgb(23, 23, 23)');
        $draw->setFont('Times');
        $draw->setFontSize(30);
        $draw->setFillColor($pixel);
        $image->annotateImage($draw, 10, 45, 0, $title);

        $image->setImageFormat('png');
//        echo $image->getFormat();
        return response($image->getImageBlob())
            ->header('Content-Type', 'image/png');
//        header('Content-Type: image/png');
//        echo $image;
//        dd(\Imagick::getVersion(), $title);
    }
}
