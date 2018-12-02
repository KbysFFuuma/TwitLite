<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  // テーブル名
  protected $table = 'favorites';

  // プライマリキー設定
  protected $primaryKey = ['favorittingUserId', 'favoritedPostId'];
  // increment無効化
  public $incrementing = false;

  protected $fillable = ['favorittingUserId', 'favoritedPostId'];
}
