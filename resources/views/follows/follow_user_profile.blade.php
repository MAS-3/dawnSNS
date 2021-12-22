@extends('layouts.login')

@section('content')

<!-- プロフィール -->
<div class="f_wrapper">

    <div class="head_line">
        <h2>TIMELINE</h2>
    </div>

    <div class="f_profile">
        <div class="flex">
            <div class="left">
                <div class="f_icon">
                    <img src="{{asset('images/' . $f_user_profile->images)}}" alt="">
                </div>
            </div>

            <div class="right">
                <div class="f_name">
                    <p>USER NAME</p>
                    <p>{{$f_user_profile->username}}</p>
                    <p>bio</p>
                    <p>{{$f_user_profile->bio}}</p>
                </div>
            </div>
        </div>
    </div>


<!--ユーザーステータス -->
    <div class="f_status">
        <!-- ツイート数 -->
        <div class="f_posts_count">
            <p>ツイート数</p>
            <p>{{$tweets}}</p>
        </div>
        <!-- フォロワー数 -->
        <div class="f_followers">
            <p>フォロワー数</p>
            <p>{{$f_followed}}</p>
        </div>
        <!-- フォロー数 -->
        <div class="f_following">
            <p>フォロー数</p>
            <p>{{$f_following}}</p>
        </div>
    </div>
    <!-- フォローボタン -->
    <div class="f_profile_follow_btn">
        @if(is_null($f_btn))
            <button class="neumo btn_1">
                <a href="/follow/{{$f_btn[0]}}">フォローする</a>
            </button>
        @else
            @if(in_array(Auth::id(), $f_btn))
                <button class="neumo btn_1">
                    <a href="/unfollow/{{$f_btn[0]}}">フォローを外す</a>
                </button>
            @else
                <button class="neumo btn_1">
                    <a href="/follow/{{$f_btn[0]}}">フォローする</a>
                </button>
            @endif
        @endif
    </div>


<!-- 投稿一覧 -->
    <div class="f_tweet">
        @foreach($f_tweet as $tweet)
        <table>
            <div class="left">
                <tr>
                    <td>
                        <div class="f_icon">
                            <img src="{{asset('/images/'. $tweet->images)}}" alt="アイコン">
                        </div>
                    </td>
                    <td>
                        <p>{{$tweet->username}}</p>
                        <p>{{$tweet->posts}}</p>
                    </td>
                </tr>
            </div>
        </table>
        @endforeach
    </div>

</div>

@endsection