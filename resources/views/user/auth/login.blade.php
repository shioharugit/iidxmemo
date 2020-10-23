@extends('user.layouts.index')
@section('title', 'ログイン | IIDXMEMO')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">HOME</a></li>
            <li class="breadcrumb-item active" aria-current="page">ログイン</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">ログイン</div>

        <div class="card-body">
            @if (!empty(session('messages')))
                <div class="alert alert-success" role="alert">
                    @foreach (session('messages') as $message)
                        {{ $message }}<br>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('user.login') }}">
                @csrf

                <div class="form-group row">
                    <label for="login_id" class="col-md-3 col-form-label text-md-right">ログインID</label>

                    <div class="col-md-6">
                        <input id="login_id" type="text" class="form-control zen2han @error('login_id') is-invalid @enderror" name="login_id" value="{{ old('login_id') }}">

                        @error('login_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-form-label text-md-right">パスワード</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-4 mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary w-150px">
                            ログイン
                        </button>
                    </div>
                </div>

                <div class="form-group row mt-4 mb-4">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                次回から入力を省略
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row text-center">
                    <div class="col-md-12">
                        <a class="btn btn-link" href="{{ route('user.preregister') }}">
                            新規登録はこちら
                        </a><a class="btn btn-link" href="{{ route('user.password') }}">
                            パスワードをお忘れの方はこちら
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
