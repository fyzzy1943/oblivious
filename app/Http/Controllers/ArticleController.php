<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
    public function index($serial = '')
    {
        if ($serial == '') {
            $articles = Article::orderBy('articles.created_at', 'desc')->join('rules', 'articles.serial', 'rules.serial')->get();
            return view('article.index')->with('articles', $articles);
        } else {
            $articles = Article::where('articles.serial', $serial)->orderBy('articles.created_at', 'desc')->join('rules', 'articles.serial', 'rules.serial')->get();
            return view('article.index')->with('articles', $articles);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Article $article)
    {
        return view('article.show')->with($article->toArray());
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
}
