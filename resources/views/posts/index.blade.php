@extends('layouts.login')

@section('content')

<div class="top">

<!-- 新規投稿 -->
<div class="tweet_post">
    <form class="tw_post_container" action="createTweet" method="POST">
        {{ csrf_field() }}
        <div class="tw_input_wrapper">
            <input class="tw_input" type="textarea" cols="60" row="3" name="post" required placeholder="ツイートを入力">
            @if($errors->has('post'))
                {{$errors->first('post')}}
            @endif
        </div>
        <input type="hidden" name="id" value="{{$auth->id}}">
        <button class="tw_post_btn neumo" type="submit">
            <i class="far fa-paper-plane"></i>
        </button>
    </form>
</div>


<!-- タイムライン -->
<div class="time_line">
    @foreach($tweets as $tweets)
                <div class="tweet flex">
                    <!-- ユーザー情報 -->
                    <div class="tw_user">
                        <img src="{{asset('images/'.$tweets->images)}}" alt="投稿者アイコン">
                        <p>{{$tweets->username}}</p>
                    </div>

                    <!-- 投稿 -->
                    <div class="tw_posts">
                        <p class="posts">{{$tweets->posts}}</p>
                    </div>

                    <div class="tw_r">
                        <div class="tw_btns">
                            <!-- 編集ボタン -->
                            <a class="modalopen btn neumo" data-target="modal{{$tweets->id}}" href=""><i class="far fa-edit"></i></a>
                            <!-- 削除ボタン -->
                            <a class="post_delete btn neumo" href="/deleteTweet/{{$tweets->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </div>

                        <p class="created_at"><span class="small">{{$tweets->created_at}}</span></p>
                    </div>
                </div>

       <!--  投稿編集モーダル -->
                <div id="modal{{$tweets->id}}" class="modal-main">
                    <form action="editTweet" method="post">
                        {{ csrf_field() }}
                        <input class="edit_tweet_input" type="text" name="posts" value="{{$tweets->posts}}">
                        <input type="hidden" name="id" value="{{$tweets->id}}">
                        <button class="modalClose edit_tweet_btn neumo" type="submit">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                </div>

    @endforeach()
</div>

</div>

@endsection