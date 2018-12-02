<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postTweet extends Model
{
  //テーブル名の定義
  protected $table = 'postTweets';

  //主キーの設定
  protected $primaryKey = 'postId';

  function getId() {
    return $this->postId;
  }
}
