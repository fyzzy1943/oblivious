<?php

namespace App\Http\Controllers;

use App\BlockUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockUrlController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('block_url.index')->with('blocks', BlockUrl::all());
    }

    public function create()
    {
        return view('block_url.create');
    }

    public function store(Request $request)
    {
        $block = new BlockUrl();
        $block->url = $request->input('url');
        $block->enabled = 1;
        $block->uid = Auth::user()->id;

        $block->save();

        return redirect('/block_urls')->with('info', ['新建成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function destroy($id)
    {
        $block = BlockUrl::findOrFail($id);

        $block->delete();

        return redirect('/block_urls')->with('info', ['删除成功']);
    }
}
