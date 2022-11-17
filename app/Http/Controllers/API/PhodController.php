<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Phod;
use Illuminate\Http\Request;
use App\Http\Requests\PhodRequest;
use App\Http\Requests\StorePhodRequest;
use App\Http\Requests\UpdatePhodRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Contact;
use App\Models\Tag;

class PhodController extends Controller {

    public function __construct() {
        return $this->authorizeResource(Phod::class, 'phod');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tag $tag) {
        $phods = Phod::all();
        $tags = Tag::all();
        // 検索機能

        $title = $request->title;

        // query()はURLの？以降のパラメータ
        $params = $request->query();
        $phods = Phod::search($params)->latest()->paginate(12);

        // appends配列を追加し、ページネーションでも検索可能
        $phods->appends(compact('title'));
        // return view('phods.index', compact('phods', 'tags'));
        return response()->json($phods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $phod = new Phod($request->all());
        // $phod->user_id = $request->tag()->id;

        // $phod->tag_id = $tag->id;

        $phod->user_id = $request->user()->id;
        $phod->tag_id = $request->tag_id;

        $file = $request->file('image');
        $phod->image = self::createFilename($file);

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 登録
            $phod->save();

            // 画像アップロード
            if (!Storage::putFileAs('images/phods', $file, $phod->image)) {
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            // return back()->withInput()->withErrors($e->getMessage());
            logger($e->getMessage());
            return response(status: 500);
        }

        // return redirect()
        //     ->route('posts.show', $phod)
        // ->with('notice', '写真を登録しました');
        return response()->json($phod, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function show(Phod $phod) {
        $phods = Phod::all();
        // return view('phods.show', compact('phod'));
        return response()->json($phod);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phod  $phod
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhodRequest $request, Phod $phod) {
        $phod->fill($request->all());

        // (cannot)更新権限を確認するメソッド
        // if ($request->user()->cannot('update', $phod)) {
        //     return redirect()
        //         ->route('phods.show', $phod)
        //         ->withErrors('自分の写真以外は更新できません');
        // }

        $file = $request->file('image');
        if ($file) {
            // 更新前の画像ファイルのファイル名を保持
            $delete_file_path = $phod->image_path;
        }
        logger($request->file('image'));
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
            // return back()->withInput()->withErrors($e->getMessage());
            logger($e->getMessage());
            return response(status: 500);
        }

        // return redirect()
        //     ->route('phods.show', $phod)
        //     ->with('notice', '写真を更新しました');
        return response()->json($phod, 200);
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
            // DB::rollback();
            // return back()->withInput()->withErrors($e->getMessage());
            logger($e->getMessage());
            return response(status: 500);
        }

        // return redirect()->route('phods.index')
        //     ->with('notice', '写真を削除しました');
        return response()->json($phod, 204);
    }

    // テーブルメソッド
    public function table(Request $request) {
        $title = $request->title;
        // $score_id = $request->score_id;

        $params = $request->query();
        $phods = Phod::search($params)->latest()->paginate(12);
        // $photos->appends(compact('title', 'score_id'));
        return view('phods.table', compact('phods'));
    }

    // (getClientOriginalName)画像ファイル名を取得
    private static function createFileName($file) {
        return date('YmdHis') . '_' . $file->getClientOriginalName();
    }
}
