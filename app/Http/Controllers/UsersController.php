<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class UsersController extends Controller
{

    //ユーザー検索画面
    public function search(Request $request){
        if ($request->isMethod('post')) {
            // 検索結果表示
            $searchWord = $request->search;

            $userList = DB::table('users')
                ->leftJoin('follows', 'users.id', '=', 'follows.followed')
                ->where('users.id','<>', Auth::id())
                ->where('users.username', 'LIKE', "%$searchWord%" )
                ->select('users.*', 'follows.follower', 'follows.followed')
                ->get();

           return view('users.search',compact('userList','searchWord'));
        }else{
            //通常表示
            $userList = DB::table('users')
                ->leftJoin('follows', 'users.id', '=', 'follows.followed')
                ->where('users.id','<>', Auth::id())
                ->select('users.*', 'follows.follower', 'follows.followed')
                ->get();

            return view('users.search',compact('userList'));
        }
    }

    // フォローする
    public function followBtn($id){
        DB::table('follows')
        ->insert([
            'follower' => Auth::id(),
            'followed' => $id
        ]);
    return redirect('search');
    }

    // フォローを外す
    public function unfollowBtn($id){
        DB::table('follows')
        ->where('follower', '=', Auth::id())
        ->where('followed', '=', $id)
        ->delete();
    return redirect('search');
    }


    public function profile(){
        return view('users.profile');
    }

}
