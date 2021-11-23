@extends('layouts.logout')

@section('content')

<div class="register_container">

<form action="/register" method="post">
{{ csrf_field() }}

    <h2>新規ユーザー登録</h2>
    <p>登録するユーザー情報を入力してください</p>

<!-- ユーザー名 -->
    <div class="input_username">
        <label for="">ユーザー名</label>
        <div class="">
            <input type="text" class="input" name="username" value="">
        </div>
        @if($errors->has('username'))
            {{$errors->first('username')}}
        @endif()
    </div>

<!-- メールアドレス -->
    <div class="input_mail">
        <label for="">メールアドレス</label>
        <div class="">
            <input type="mail" class="input" name="mail" value="">
        </div>
        @if($errors->has('mail'))
            {{$errors->first('mail')}}
        @endif()
    </div>

<!-- パスワード -->
    <div class="input_password">
        <label for="">パスワード</label>
        <div class="">
            <input type="password" class="input" name="password" value="">
        </div>
        @if($errors->has('password'))
            {{$errors->first('password')}}
        @endif()
    </div>

<!-- パスワード確認入力 -->
    <div class="input_password">
        <label for="">パスワード(確認)</label>
        <div class="">
            <input type="password" class="input" name="password-confirm" value="">
        </div>
        <p>
            <small>※パスワード欄と同じパスワードを入力してください</small>
        </p>
        @if($errors->has('password-confirm'))
            {{$errors->first('password-confirm')}}
        @endif()
    </div>

    <input type="submit" value="登録">


<!-- トップ画面へ戻る -->
    <p>
        <a href="/login">ログイン画面へ戻る</a>
    </p>

    </form>

</div>


@endsection
