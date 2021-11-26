@extends('layouts.login')

@section('content')
<div class="search_blade page-wrapper">

    <div class="head_line">
        <h2>SEARCH</h2>
    </div>


<!-- ユーザー検索窓 -->
<div class="search_window">
    <form class="" action="search" method="POST">
        {{ csrf_field() }}
        <div class="search_input_wrapper">
            <p>誰を探しますか？</p>
            <input class="search_input" type="textarea" cols="60" row="3" name="search" required placeholder="">
        </div>
        <button class="neumo btn_2" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <!-- 検索結果 -->
    <div class="search_relust">
        @if(!empty($searchWord))
            <p>検索ワード：</p>{{$searchWord}}
        @endif
    </div>
</div>


<!-- ユーザーリスト -->
<div class="user_list">
    <!-- コンテナ -->
    @foreach($userList as $list)
        <div class="list_container">
            <div class="inner">
                <div class="user_icon">
                    <img src="{{asset('images/' . $list->images)}}" alt="ユーザーアイコン">
                </div>

                <div class="user_center">
                    <div class="user_name item">
                        <h3 class="item_name">USERNAME</h3>
                        <p class="user_text">{{$list->username}}</p>
                    </div>
                    <div class="user_h">
                        <h3 class="item_name">PROFILE</h3>
                        <p class="user_text">{{$list->bio}}</p>
                    </div>
                </div>

                 <div class="follow_btn">
                    @if(is_null($list->follower))
                        <button class="neumo btn_1">
                            <a href="/follow/{{$list->id}}">フォローする</a>
                        </button>
                    @else
                        @if(Auth::id() == $list->follower)
                            <button class="neumo btn_1">
                                <a href="/unfollow/{{$list->id}}">フォローを外す</a>
                            </button>
                        @else
                            <button class="neumo btn_1">
                                <a href="/follow/{{$list->id}}">フォローする</a>
                            </button>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>


</div>
@endsection