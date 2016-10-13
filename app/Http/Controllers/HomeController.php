<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rule;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $str = '  hello world　　';
//        var_dump(trim($str, '　 '));
        return view('home.welcome');
    }

    public function board()
    {
        $article_total = Article::count();
        $article_review = Article::where('review', 1)->count();

        $column_update_times = Rule::sum('update_times');
        $column_regex_times = Rule::sum('regex_times');

//        dd($article_total, $article_review, $column_update_times, $column_regex_times);
        return view('home.board', [
            'article_total' => $article_total,
            'article_review' => $article_review,
            'article_un_review' => $article_total - $article_review,
            'column_update_times' => $column_update_times,
            'column_regex_times' => $column_regex_times,
        ]);
    }
}
