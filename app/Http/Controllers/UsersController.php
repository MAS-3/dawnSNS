<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;

class UsersController extends Controller
{

    //=========================
    //ユーザー検索画面
    //=========================
    public function search(Request $request){
        if ($request->isMethod('post')) {
            // 検索結果表示
            $searchWord = $request->search;

            $userList = DB::table('users')
                ->leftJoin('follows', 'users.id', '=', 'follows.following')
                ->where('users.id','<>', Auth::id())
                ->where('users.username', 'LIKE', "%$searchWord%" )
                ->select('users.*', 'follows.following', 'follows.follower')
                ->get();

           return view('users.search',compact('userList','searchWord'));
        }else{
            //通常表示
            $userList = DB::table('users')
                ->leftJoin('follows', 'users.id', '=', 'follows.following')
                ->where('users.id','<>', Auth::id())
                ->select('users.*', 'follows.following', 'follows.follower')
                ->get();
            return view('users.search',compact('userList'));
        }
    }

    // フォローする
    public function followBtn($id){
        DB::table('follows')
        ->insert([
            'following' => $id,
            'follower' => Auth::id()
        ]);
    return back();
    }

    // フォローを外す
    public function unfollowBtn($id){
        DB::table('follows')
        ->where('following', '=', $id)
        ->where('follower', '=', Auth::id())
        ->delete();
    return back();
    }


    //=========================
    //プロフィール編集画面
    //=========================
    public function profile(Request $request){

        $userData = Auth::user();

        if ($request->isMethod('post')) {//POSTで来たときの処理
            //編集入力がされた場合の処理
            $input = $request->input();
            //バリデーション処理
            $pro_val = $this->proVlidator($input);
            //登録処理
            $this->proUpdate($input);
        }else{
            return view('users.profile');
        }
    }
    // プロフィールアップデート処理
    protected function proUpdate($input){
        if(isset($input->password) && isset($input->image)){
            DB::table('users')
                ->update([
                    'username' => $input->username,
                    'mail' => $input->mail,
                    'bio' => $input->bio,
                ]);
            return back();
        }else if(!isset($input->password) && isset($input->image)){

        }else if(isset($input->password) && !isset($input->image)){

        }else{

        }
    }
    // プロフィールアップデートバリデーター
    protected function proVlidator($input){
        $role = [
            //ルール
            'username' => 'required|string|min:4|max:25',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|max:255|same:password-confirm',
            'password-confirm' => 'required'
        ];
        dd($role);
        return Validatior::make($input,$role,$message);
    }

}
