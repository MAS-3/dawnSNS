@extends('layouts.login')

@section('content')

<!-- ユーザーリスト -->
<div class="page-wrapper">

<!-- コンテナ -->

<!-- ページタイトル分岐 -->
<?php if ($page_name == 'following_list'): ?>
    <div class="head_line">
        <h2>FOLLOWING USER LIST</h2>
    </div>

    <!-- フォローなしメッセージ -->
    @if(empty($follow_tweet[0]->username))
        <div class="post_empty">
            <p>まずは誰かをフォローしてみよう！</p>
        </div>
    @endif

<?php elseif ($page_name == 'followed_list'):?>
    <div class="head_line">
        <h2>FOLLOWED USER LIST</h2>
    </div>

    <!-- フォロワーーなしメッセージ -->
    @if(empty($follow_tweet[0]->username))
        <div class="post_empty">
            <p>たくさん投稿をして、フォロワーを増やそう！</p>
        </div>
    @endif
<?php endif;?>


<!-- ツイートリスト -->
    @foreach($follow_tweet as $list)
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
                            <a class="" href="/follow_profile/{{$list->id}}">MORE</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection