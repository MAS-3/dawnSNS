<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

       public function __construct(){
        //ログインしていない場合は、ログイン画面へ移動する
        $this->middleware('auth');
        // 全てのページで共通に使える情報をビューに送る
        $this->middleware(function($request, $next){

            // ログインユーザー情報
            $auth = Auth::user();

            // フォロー人数カウント
            $followed_count = \DB::table('follows')
                ->where('follower',$auth->id)
                ->count();

            // フォロワー人数カウント
            $follower_count = \DB::table('follows')
                ->where('following',$auth->id)
                ->count();

            View::share('auth', $auth);
            View::share('image_url', asset('storage/usersIcon/'.$auth['image']));
            View::share('followed_count', $followed_count);
            View::share('follower_count', $follower_count);

            return $next($request);
        });
    }

}
