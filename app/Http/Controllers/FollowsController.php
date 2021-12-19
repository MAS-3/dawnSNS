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
        $pageName = 'FollowingList';

        //ユーザーアイコン
        $followingIcon = DB::table('follows')
                            ->leftJoin('users', 'follows.following', '=', 'users.id')
                            ->where('follows.follower', '=', Auth::id())
                            ->get();

        //フォローユーザーツイート
        $followingTweet = DB::table('follows')
                            ->join('users', 'follows.follower', '=', 'users.id')
                            ->join('posts', 'users.id' , '=' ,'posts.user_id')
                            ->where('follows.follower', '=', Auth::id())
                            ->latest('posts.created_at')
                            //->groupBy('username')//エラーが出る。
                            ->get();

        return view('follows.followList', [
            'pageName' => $pageName,
            'followIcon' => $followingIcon,
            'followTweet' => $followingTweet
        ]);
    }


    //=========================
    //Followerリスト
    //=========================
    public function followedList(){
        // ページ名
        $pageName = 'FollowedList';

        //ユーザーアイコン
        $followedIcon = DB::table('follows')
                            ->leftJoin('users', 'follows.follower', '=', 'users.id')
                            ->where('follows.follower', '=', Auth::id())
                            ->get();

        //フォローユーザーツイート
        $followedTweet = DB::table('follows')
                            ->join('users', 'follows.following', '=', 'users.id')
                            ->leftJoin('posts', 'users.id' , '=' ,'posts.user_id')
                            ->where('follows.following', '=', Auth::id())
                            ->latest('posts.created_at')
                            //->groupBy('username')//エラーが出る。
                            ->get();

        return view('follows.followList',[
            'pageName' => $pageName,
            'followIcon' => $followedIcon,
            'followTweet' => $followedTweet
        ]);
    }


    //=========================
    //ユーザー詳細ページ
    //=========================
    public function followDetail($id){
        // ユーザーID
        $followUserId = $id;

        

    }
}
