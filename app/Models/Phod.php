<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class Phod extends Model {
    use HasFactory;

    protected $fillable =
    [
        'title',
        'place',
        'body',
        'tag',

        'name',
        'email',
        'message',
    ];



    // 検索用のスコープ
    // $paramsはrequestのパラメータを受け取る
    public function scopeSearch(Builder $query, $params) {
        if (!empty($params['title'])) {
            // where(検索したいカラム名,検索の条件,条件を追加)
            $query->where('title', 'like', '%' . $params['title'] . '%');
        }
        // if (!empty($params['score_id'])) {
        //     $query->where('score_id', 'like', '%' . $params['score_id'] . '%');
        // }

        return $query;
    }

    // (belongsTo)1件の写真は1人のユーザーに紐付いている
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute() {
        return Storage::url($this->image_path);
    }

    // 画像のパスを読み出し
    public function getImagePathAttribute() {
        return 'images/phods/' . $this->image;
    }
}
