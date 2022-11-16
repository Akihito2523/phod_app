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
        'created_at',

        'name',
        'email',
        'message',
    ];

    //appends: アクセサの値を渡す値に含める
    protected $appends = [
        'user_name',
        'image_url',
        'tag_type',
    ];

    //hidden: 渡す値に含めない
    protected $hidden = [
        // 'image',
        'user_id',
        'updated_at',
        'user',
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

    // (belongsTo)1枚の写真は1人のユーザーに紐付いている
    public function user() {
        return $this->belongsTo(User::class);
    }

    // (belongsTo)1枚の写真は1つのタグに紐付いている
    public function tag() {
        return $this->belongsTo(Tag::class);
    }
//s


    public function getImageUrlAttribute() {
        return Storage::url($this->image_path);
    }

    // 画像のパスを読み出し
    public function getImagePathAttribute() {
        return 'images/phods/' . $this->image;
    }

    //appendsにユーザー名を渡す
    public function getUserNameAttribute() {
        return $this->user->name;
    }

    public function getTagTypeAttribute() {
        return $this->tag->type;
    }
}
