<!-- header & grobal navi -->
<nav class="navbar navbar-expand-md navbar-dark bg-info mb-4">
    <a class="navbar-brand" href="{{ route('admin.login') }}">IIDXMEMO管理画面</a>
    @if (Auth::guard('admin')->check())
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="true" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="Navbar" style="">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">楽曲</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.music.index') }}">一覧</a>
                        <a class="dropdown-item" href="{{ route('admin.music.create') }}">登録</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ユーザー</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.user.index') }}">一覧</a>
                        <a class="dropdown-item" href="{{ route('admin.user.create') }}">登録</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">メモ</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.memo.create') }}">登録</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" onclick="if (confirm('ログアウトしますか?')) {location.href = '{{ route('admin.logout') }}'; }return false;">ログアウト</a>
                </li>
            </ul>
        </div>
    @endif
</nav>
