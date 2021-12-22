<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowsController extends Controller
{
    //=========================
    //Followリスト
    //=========================
    public function followingList(){
        // ページ名
        $page_name = 'following_list';

        //ユーザーアイコン
        $following_icon = DB::table('follows')
                            ->leftJoin('users', 'follows.following', '=', 'users.id')
                            ->where('follows.follower', '=', Auth::id())
                            ->get();

        //フォローユーザーツイート
        $following_tweet = DB::table('follows')
                            ->join('users', 'follows.following', '=', 'users.id')
                            ->leftJoin('posts', 'users.id' , '=' ,'posts.user_id')
                            ->where('follows.follower', '=', Auth::id())
                            //->where('users.id','<>',Auth::id())
                            ->latest('posts.created_at')
                            ->select(
                                    'users.id',
                                    'users.username',
                                    'users.mail',
                                    'users.images',
                                    'users.bio',
                                    'posts.posts'
                                    )
                            //->groupBy('username')//エラーが出る。
                            ->get();


        return view('follows.follow_list', [
            'page_name' => $page_name,
            'follow_icon' => $following_icon,
            'follow_tweet' => $following_tweet
        ]);
    }


    //=========================
    //Followerリスト
    //=========================
    public function followedList(){
        // ページ名
        $page_name = 'followed_list';

        //ユーザーアイコン
        $followed_icon = DB::table('follows')
                            ->leftJoin('users', 'follows.follower', '=', 'users.id')
                            ->where('follows.follower', '=', Auth::id())
                            ->get();

        //ユーザーステータス
        $follow_status = DB::table('users')
                ->leftJoin('follows', 'users.id', '=', 'follows.following')
                ->where('users.id','<>', Auth::id())
                ->select('follows.following', 'follows.follower')
                ->get();

        //フォローユーザーツイート
        $followed_tweet = DB::table('follows')
                            ->join('users', 'follows.following', '=', 'users.id')
                            ->leftJoin('posts', 'users.id' , '=' ,'posts.user_id')
                            ->where('follows.following', '=', Auth::id())
                            ->latest('posts.created_at')
                            ->select(
                                    'users.id',
                                    'users.username',
                                    'users.mail',
                                    'users.images',
                                    'users.bio',
                                    'posts.posts'
                                    )
                            //->groupBy('username')//エラーが出る。
                            ->get();

        return view('follows.follow_list',[
            'page_name' => $page_name,
            'follow_icon' => $followed_icon,
            'follow_status' => $follow_status,
            'follow_tweet' => $followed_tweet
        ]);
    }


    //=========================
    //ユーザー詳細ページ
    //=========================
    public function followDetail($id){
        // ユーザーID
        $f_user_id = $id;

        //ユーザープロフィール
        $f_user_profile = DB::table('users')
                            ->leftJoin('posts','users.id','=','posts.user_id')
                            ->where('users.id','=',$f_user_id)
                            ->first();

        //----------------
        //ユーザーステータス
        //----------------

        //投稿数
        $tweets = DB::table('posts')
                ->where('user_id','=',$id)
                ->count();

        //フォロワー
        $f_followed = DB::table('follows')
                ->where('following','=',$id)
                ->count();
        //フォロー
        $f_following = DB::table('follows')
                ->where('follower','=',$id)
                ->count();

        //フォローボタン
        $f_btn = DB::table('follows')->where('following', $f_user_id)->pluck('follower')->toArray();

        // ユーザー投稿
        $f_tweet = DB::table('posts')
                            ->leftJoin('users','posts.user_id','users.id')
                            ->where('user_id','=',$f_user_id)
                            ->get();

        //dd($f_tweet);

        return view('follows.follow_user_profile',[
            'f_user_profile' => $f_user_profile,
            'f_btn' => $f_btn,
            'f_tweet' => $f_tweet,
            'tweets' => $tweets,
            'f_followed' => $f_followed,
            'f_following' => $f_following
        ]);
    }
}
