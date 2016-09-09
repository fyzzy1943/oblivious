<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
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
            ->orderBy('created_at', 'desc')
            ->limit($num)
            ->get();

        return count($articles) != 0 ? $articles->toJson() : 'null';
    }
}
