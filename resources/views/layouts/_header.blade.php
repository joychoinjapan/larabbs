<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand " href="{{ url('/') }}">
            LaraBBS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" id="category-list">
                <li class="nav-item active"><a class="nav-link" href="{{route('topics.index')}}">分類</a></li>
                <li class="nav-item" id="category-1"><a class="nav-link" href="{{route('categories.show',1)}}">シェア</a></li>
                <li class="nav-item" id="category-2"><a class="nav-link" href="{{route('categories.show',2)}}">コース</a></li>
                <li class="nav-item" id="category-3"><a class="nav-link" href="{{route('categories.show',3)}}">質問回答</a></li>
                <li class="nav-item" id="category-4"><a class="nav-link" href="{{route('categories.show',4)}}">お知らせ</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item"><a class="nav-link" href="/login">ログイン</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">新規登録</a></li>
                @else
                    <li class="nav-item"><a class="nav-link mt-1 mr-3 font-weight-bold" href="{{route('topics.create')}}"><i class="fa fa-plus"></i></a></li>
                    <li class="nav-item notification-badge">
                        <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count>0?'hint':'secondary' }} text-white"
                           href="{{route('notifications.index')}}">
                            {{ Auth::user()->notification_count }}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://cdn.learnku.com/uploads/images/201801/03/1/xJOU6N13zW.jpg" class="img-responsive img-circle" width="30px" height="30px">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('users.show',Auth::id())}}">アカウント</a>
                            <a class="dropdown-item" href="{{route('users.edit',Auth::id())}}">プロフィール編集</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" id="logout" href="#">
                                <form action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-danger" type="submit" name="button">ログアウト</button>
                                </form>
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
