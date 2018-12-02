<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //テーブル名
    protected $table = 'followers';

    //プライマリー設定
    protected $primaryKey = ['followingUserId', 'followedUserId'];
    //increment無効化
    public $incrementing = false;

    protected $fillable = ['followingUserId', 'followedUserId'];
}
