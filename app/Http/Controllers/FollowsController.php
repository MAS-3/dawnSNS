<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class FollowsController extends Controller
{
    //
    public function followingList(){
        $followingIcon = DB::table('follows')
                            ->leftJoin('users', 'follows.following', '=', 'users.id')
                            ->where('follows.follower', '=', Auth::id())
                            ->get();

        // ONLY_FULL_GROUP_BYでgroupBy出来ず
        $followingTweet = DB::table('follows')
                            ->join('users', 'follows.follower', '=', 'users.id')
                            ->join('posts', 'users.id' , '=' ,'posts.user_id')
                            ->where('follows.follower', '=', Auth::id())
                            ->latest('posts.created_at')
                            //->groupBy('username')
                            ->get();

        return view('follows.followingList', compact('followingIcon','followingTweet'));
    }

    public function followedList(){
        return view('follows.followedList');
    }
}
