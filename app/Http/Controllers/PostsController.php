<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{


    //トップ画面
    public function index(){
        //タイムライン
        $tweets = DB::table('posts')
                    ->leftjoin('users','posts.user_id','=','users.id')
                    ->select(
                        'posts.*',
                        'users.username',
                        'users.images'
                        )
                    ->orderByDesc('posts.id')
                    ->get();

        return view('posts.index',compact('tweets'));
    }


    //新規投稿
    public function createTweet(Request $request){
        // 投稿バリデーション
        $val = $this->validator($request->input());
        if($val->fails()){//バリデーションに引っかかったときの処理
            return redirect('top')
            ->withErrors($val)
            ->withInput();
        }else{//通ったときの処理
            // 投稿の保存
            DB::table('posts')
                ->insert([
                    'user_id' => $request->input('id'),
                    'posts' => $request->input('post'),
                    'created_at' => now(),
                    'updated_at' => now()
                        ]);
            return redirect('top');
        }
    }
    //新規投稿バリデーション
    protected function validator(array $data){
        //dd($data);
        return Validator::make($data,[
            // バリデーションルール
            'post' => 'required|string|max:140',
        ],[
            'post.required' => '入力してください',
            'post.string' => '文字を入力してください',
            'post.max' => '140文字以内で入力してください'
        ]);
    }

    // 投稿削除
    public function deleteTweet($id){
        DB::table('posts')
            ->where('id', $id)
            ->delete();
        return redirect('top');
    }

    // 投稿の更新
    public function editTweet(Request $request)
    {
        $postId = $request->input('id');
        $updatePost = $request->input('posts');

        DB::table('posts')
            ->where('id','=',$postId)
            ->update([
                'posts' => $updatePost
                ]);

        return redirect('/top');
    }
}
