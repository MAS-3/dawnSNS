<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
        public function indexTweet()
    {
        return $this->belongsToMany(
                            'App\User',//結合テーブル(モデル)
                            'post_user',//結合テーブル名
                            'users_id',//このモデルの外部キー名
                            'id'//結合モデルの外部キー名
                                    );
    }
}
