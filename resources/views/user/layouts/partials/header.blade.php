<!-- header & grobal navi -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="{{ route('user.login') }}">IIDXMEMO</a>
    @if (Auth::guard('user')->check())
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar" aria-controls="Navbar" aria-expanded="true" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="Navbar" style="">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.memo.index') }}" >メモ一覧</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.edit') }}" >ユーザー更新</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" onclick="if (confirm('ログアウトしますか?')) {location.href = '{{ route('user.logout') }}'; }return false;">ログアウト</a>
                </li>
            </ul>
        </div>
    @endif
</nav>
