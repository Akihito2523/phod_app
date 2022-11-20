<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

   // (hasMany)1枚の写真には複数のタグに紐付いている
    public function phods() {
        return $this->hasMany(Phod::class);
    }
}
