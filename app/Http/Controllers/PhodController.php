<?php

namespace App\Http\Controllers;

use App\Models\Phod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class PhodController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $phods = Phod::all();
        // 検索機能
        $title = $request->title;

        // query()はURLの？以降のパラメータ
        $params = $request->query();
        $phods = Phod::search($params)->latest()->paginate(12);

        // appends配列を追加し、ページネーションでも検索可能
        $phods->appends(compact('title'));
        return view('phods.index', compact('phods'));
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
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function show(Phod $phod) {
        // $phods = Phod::all();
        return view('phods.show', compact('phod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function edit(Phod $phod) {
        // $phods = Phod::all();
        return view('phods.edit', compact('phod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phod $phod) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phod $phod) {
        //
    }

    // テーブルメソッド
    public function table(Request $request) {
        $title = $request->title;
        // $score_id = $request->score_id;

        $params = $request->query();
        $phods = Phod::search($params)->latest()->paginate(12);
        // $photos->appends(compact('title', 'score_id'));
        return view('phods.table', compact('phods'));

        // Photoモデル全件検索する箱
        // $query = Photo::query();

        // if (!empty($title)) {
        //     $photos = Photo::where('title', 'like', '%' . $title . '%')
        //         ->paginate(10);
        //     // $photos->appends(compact('title'));
        // }

        // if (!empty($score_id)) {
        //     $query->where('score_id', 'like', '%' . $score_id . '%');
        //     $photos  = $query->paginate(10);
        // }
    }

    // お問い合わせ
    public function contact(Request $request, Phod $phod) {
        return view('phods.contact');
    }


    // (getClientOriginalName)画像ファイル名を取得
    private static function createFileName($file) {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
