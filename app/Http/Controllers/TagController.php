<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Phod;
use Illuminate\Support\Facades\DB;

class TagController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, Phod $phod) {
        $tag->type = $request->type;
        // dd($tag->type );

        // if ($request->user()->cannot('update', $tag)) {
        //     return redirect()
        //         ->route('tags.tags', $tag)
        //         ->withErrors('ログインしていないと更新できません');
        // }

        $tag->save();

        return redirect()
            ->route('tags.index')
            ->with('notice', 'タグを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag) {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag) {
        $tag->type = $request->type;

        $tag->save();

        // (cannot)更新権限を確認するメソッド
        // if ($request->user()->cannot('update', $$tag)) {
        //     return redirect()
        //         ->route('tags.index', $tag)
        //         ->withErrors('自分のタグ以外は更新できません');
        // }

        return redirect()
            ->route('tags.index')
            ->with('notice', 'タグを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag) {
        $tag->delete();
        return redirect()
            ->route('tags.index')
            ->with('notice', 'タグを削除しました');
    }
}
