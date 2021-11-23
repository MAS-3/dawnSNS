@extends('layouts.login')

@section('content')
<div class="search_blade">


<!-- ユーザー検索窓 -->
<div class="search_window">
    <form class="" action="search" method="POST">
        {{ csrf_field() }}
        <div class="search_input_wrapper">
            <p>誰を探しますか？</p>
            <input class="search_input" type="textarea" cols="60" row="3" name="search" required placeholder="ユーザー名">
        </div>
        <input type="submit" value="検索">
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
            <div class="user_icon">
                <img src="{{asset('images/' . $list->images)}}" alt="ユーザーアイコン">

            </div>
            <div class="user_center">
                <div class="user_name">
                    <h3 class="user_h">ユーザー名</h3>
                    <p>{{$list->username}}</p>
                </div>
                <div class="user_h">
                    <h3 class="title">プロフィール</h3>
                    <p class="user_bio_text">{{$list->bio}}</p>
                </div>
            </div>
             <div class="follow_btn">
                @if(is_null($list->follower))
                    <button>
                        <a href="/follow/{{$list->id}}">フォローする</a>
                    </button>
                @else
                    @if(Auth::id() == $list->follower)
                        <button>
                            <a href="/unfollow/{{$list->id}}">フォローを外す</a>
                        </button>
                    @else
                        <button>
                            <a href="/follow/{{$list->id}}">フォローする</a>
                        </button>
                    @endif

                @endif
            </div>
        </div>
    @endforeach
</div>


</div>
@endsection