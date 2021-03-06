<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rule;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
{
    protected $fills = [
        'first'             =>  'first',
        'second'            =>  'second',
        'list_url'          =>  'list_url',
        'regex_url_area'    =>  'regex_url_area',
        'regex_url_list'    =>  'regex_url_list',
        'regex_article'     =>  'regex_article',
        'regex_title'       =>  'regex_title',
        'regex_date'        =>  'regex_date',
        'regex_text'        =>  'regex_text',
    ];

    public function index()
    {
        return view('rule.index')->with('rules', Rule::orderBy('created_at', 'desc')->get());
    }

    public function create()
    {
        return view('rule.create');
    }

    public function store(Request $request)
    {
        $rule = new Rule();

        foreach ($this->fills as $rk => $dk) {
            $rule->$dk = $request->input($rk);
        }
        $rule->setSerial();
        $rule->created_uid = Auth::user()->id;
        $rule->updated_uid = Auth::user()->id;
        $rule->review_uid = Auth::user()->id;
        $rule->update_wheel_uid = Auth::user()->id;

        $rule->save();

        return redirect('rules')->with('info', ['创建成功', $rule->first.'-'.$rule->second.'已创建']);
    }

    public function show(Rule $rule)
    {
        $articles_count = Article::where('serial', $rule->serial)->count();
        return view('rule.show')->with($rule->toArray())->with('articles_count', $articles_count);
    }

    public function edit(Rule $rule)
    {
        return view('rule.edit')->with($rule->toArray());
    }

    public function update(Request $request, $id)
    {
        $rule = Rule::findOrFail($id);

        foreach ($this->fills as $rk => $dk) {
            $rule->$dk = $request->input($rk);
        }
        $rule->auto = $request->input('auto');
        $rule->updated_uid = Auth::user()->id;

        $rule->save();

        return redirect('rules')->with('info', ['修改成功']);
    }

    public function destroy(Rule $rule)
    {
        $rule->delete();

        return redirect('rules')->with('info', ['删除成功', $rule->first.'-'.$rule->second.'已删除']);
    }
}
