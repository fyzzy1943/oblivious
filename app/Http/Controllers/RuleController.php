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

class RuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('rule.index')->with('rules', UpdateRule::all());
    }

    public function create($serial='', $first='', $second='')
    {
        $rule = UpdateRule::where('serial', $serial)->first();

        if (null == $rule) {
            return view('rule.create')->with(compact('serial', 'first', 'second'));
        } else {
            return view('rule.edit')->with($rule->toArray())->with(compact('first', 'second'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\RuleStoreRequest $request)
    {
        $ur = new UpdateRule($request->all());
        $ur->save();

        return redirect('system/category')->with('info', ['添加成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UpdateRule $rule)
    {
        return view('rule.show', $rule);
    }

    public function edit(UpdateRule $rule)
    {
        return view('rule.edit')->with('rule', $rule);
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
        $rule = UpdateRule::find($id);

        $rule->url = $request->input('url');
        $rule->url_area = $request->input('url_area');
        $rule->url_rule = $request->input('url_rule');
        $rule->content_area = $request->input('content_area');
        $rule->title_rule = $request->input('title_rule');
        $rule->date_rule = $request->input('date_rule');
        $rule->article_rule = $request->input('article_rule');

        $rule->save();

        return redirect('system/category')->with('info', ['修改成功']);
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
