<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($serial = '')
    {
        if ($serial == '') {
            $articles = Article::select('articles.id AS id', 'first', 'second', 'title', 'date', 'articles.created_at as created_at')
                ->orderBy('articles.created_at', 'desc')
                ->orderBy('articles.id', 'desc')
                ->join('rules', 'articles.serial', 'rules.serial')
                ->get();

            return view('article.index')->with('articles', $articles);
        } else {
            $articles = Article::select('articles.id AS id', 'first', 'second', 'title', 'date', 'articles.created_at as created_at')
                ->where('articles.serial', $serial)
                ->orderBy('articles.created_at', 'desc')
                ->orderBy('articles.id', 'desc')
                ->join('rules', 'articles.serial', 'rules.serial')
                ->get();

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

    public function edit(Article $article)
    {
        return view('article.edit')->with($article->toArray());
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

    public function reviewIndex()
    {
        $articles = Article::select('articles.id AS id', 'first', 'second', 'title', 'date', 'articles.created_at as created_at')
            ->where('articles.review', 0)
            ->orderBy('articles.created_at', 'desc')
            ->orderBy('articles.id', 'desc')
            ->join('rules', 'articles.serial', 'rules.serial')
            ->get();

        return view('article.review_index')->with('articles', $articles);
    }

    public function myReview()
    {
        $articles = Article::select('articles.id AS id', 'first', 'second', 'title', 'date', 'articles.created_at as created_at')
            ->where('articles.review', 0)
            ->where('review_uid', Auth::user()->id)
            ->orderBy('articles.created_at', 'desc')
            ->orderBy('articles.id', 'desc')
            ->join('rules', 'articles.serial', 'rules.serial')
            ->get();

        return view('article.review_index')->with('articles', $articles);
    }

    public function reviewForm(Article $article)
    {
        return view('article.review')->with($article->toArray());
    }

    public function review(Request $request, Article $article)
    {
        $article->title = $request->input('title');
        $article->date = $request->input('date');
        $article->article = $request->input('article');
        $article->review = 1;

        $article->save();

        return redirect('articles-under-review');
    }
}
