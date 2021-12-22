@extends('layouts.login')

@section('content')

<div class="login_user_profile">
    <form action="">
        {{ csrf_field() }}
        <input name="username" type="text">
        <input name="mail" type="mail">
        <input name="bio" type="text">
        <input type="password" value="password" readonly>
        <input name="passowrd" type="text" placeholder="新しいパスワード">
        <input type="form">
        <input type="submit" value="登録">
    </form>
</div>

@endsection