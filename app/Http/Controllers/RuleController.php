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
            return view('rule.edit')->with('rule', $rule);
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

        return redirect('system/rules');
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
        $rule = new UpdateRule($request->all());
        $rule->id = $id;

        dd($rule->toArray());
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
