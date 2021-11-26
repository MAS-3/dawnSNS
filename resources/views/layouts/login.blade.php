<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title>DAWNSNS</title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!-- font-awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
     <!-- js -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset('/js/script.js')}}"></script>
</head>
<body>

    <header class="login">
        <div class="login_header_w">
            <!-- DAWNロゴ -->
            <div class="login_header_l">
                <h1></h1>
                <div class="logo">
                    <a href="top">
                        <img src="{{asset('images/main_logo.png')}}">
                    </a>
                </div>
            </div>


            <div  class="login_header_r">
                <!-- ユーザーステータス -->
                <div id="user_status">
                    <div class="block">
                        <a class="neumo" href="following">
                            <p class="follow_num">
                                {{$followedCount}}
                                <span class="small">FOLLOWING</span>
                            </p>
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                    <div class="block">
                        <a class="neumo" href="follower">
                            <p class="follow_num">
                                {{$followerCount}}
                                <span class="small">FOLLOWER</span>
                            </p>
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                    <div class="block">
                        <p class="btn search">
                            <a class="neumo" href="/search"><i class="fas fa-search"></i><i class="fas fa-users"></i></a>
                        </p>
                    </div>
                </div>


                <!-- ユーザー名(アコーディオンボタン) -->
                <div id="" class="login_user accordion_btn">
                    <a class="neumo usr">
                        <img src="{{asset('images/'.$auth->images)}}" alt="">
                        <p><i class="fas fa-sort-down"></i></p>
                    </a>
                </div>

                <!-- アコーディオンメニュー -->
                <div class="accordion">
                    <ul>
                        <li class="username">LOGIN：{{$auth->username}}さん</li>
                        <li><a class="js_line" href="/top">HOME</a></li>
                        <li><a class="js_line" href="/profile">PROFILE</a></li>
                        <li><a class="js_line" href="/logout">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </header>

    <div id="row">

        <div id="container">
            @yield('content')
        </div >

    </div>


    <script src="JavaScriptファイルのURL"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>