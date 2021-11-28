@extends('layouts.login')

@section('content')

<!-- ユーザーリスト -->
<div class="page-wrapper">
    <!-- コンテナ -->

    <div class="head_line">
        <h2>FOLLOWER LIST</h2>
    </div>

    <!-- フォローなし -->
    @if(empty($followingTweet[0]->username))
        <div class="post_empty">
            <p>まずは誰かをフォローしてみよう！</p>
        </div>
    @endif
    @foreach($followingTweet as $list)
        <div class="user_list">
            <div class=" list_container">
                <div class="inner">
                    <div class="user_icon">
                        <img src="{{asset('images/' . $list->images)}}" alt="ユーザーアイコン">
                    </div>

                    <div class="follow_data">
                        <div class="follow_name item">
                            <h3 class="item_name">USERNAME</h3>
                            <p class="user_text">{{$list->username}}</p>
                        </div>
                        <div class="follow_h item">
                            <h3 class="item_name">PROFILE</h3>
                            <p class="user_text">{{$list->bio}}</p>
                        </div>
                    </div>

                    <div class="">
                        <div class="neumo btn_1">
                            <a class="" href="">MORE</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection