<?php

namespace App\Http\Controllers;

use App\Models\Phod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\Tag;

class PhodController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Phod $phod, Tag $tag) {
        $phods = Phod::all();
        $tags = Tag::all();
        // dd($phods);
        // 検索機能
        $title = $request->title;
        $tag_id = $request->tag_id;

        // query()はURLの？以降のパラメータ
        $params = $request->query();
        $phods = Phod::search($params)->latest()->paginate(15);

        // appends配列を追加し、ページネーションでも検索可能
        $phods->appends(compact('title', 'tag_id'));

        return view('phods.index', compact('phods', 'tags'));
        return response()->json($phods);
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
    public function store(Request $request, Contact $contact) {
        //contactsのデータベースに保存
        $contact = new Contact($request->all());
        $contact->save();
        return redirect()
            ->route('phods.index')
            ->with('notice', 'お問い合わせが完了しました。');
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
        $phod->fill($request->all());

        // (cannot)更新権限を確認するメソッド
        if ($request->user()->cannot('update', $phod)) {
            return redirect()
                ->route('phods.show', $phod)
                ->withErrors('自分の写真以外は更新できません');
        }

        $file = $request->file('image');
        if ($file) {
            // 更新前の画像ファイルのファイル名を保持
            $delete_file_path = $phod->image_path;
            $phod->image = self::createFileName($file);
        }

        // トランザクション開始
        // beginTransactionからDB::commit
        DB::beginTransaction();
        try {
            // 更新
            $phod->save();
            if ($file) {
                // 画像をアップロードする
                if (!Storage::putFileAs('images/phods', $file, $phod->image)) {
                    // 例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの保存に失敗しました。');
                }
                // 過去の画像ファイルを削除
                if (!Storage::delete($delete_file_path)) {
                    //アップロードした画像を削除する
                    Storage::delete($phod->image_path);
                    //例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }
            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()
            ->route('phods.show', $phod)
            ->with('notice', '写真を更新しました!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phod $phod) {
        // トランザクション開始
        DB::beginTransaction();
        try {
            $phod->delete();
            // 画像削除
            if (!Storage::delete($phod->image_path)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの削除に失敗しました。');
            }
            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('phods.index')
            ->with('notice', '写真を削除しました');
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

    //お問い合わせ
    public function contact(Request $request, Phod $phod) {
        return view('phods.contact');
    }

    // public function contact_store(Request $request) {
    //       //contactsのデータベースに保存
    //     $contact = new Contact($request->all());
    //     $contact->save();
    //     return redirect()
    //         ->route('phods.index')
    //         ->with('notice', 'お問い合わせが完了しました。');
    // }


    // (getClientOriginalName)画像ファイル名を取得
    private static function createFileName($file) {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
