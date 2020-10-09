@extends('user.layouts.index')
@section('title', 'ログイン')
@section('content')
    <div class="card">
        <div class="card-header">ログイン</div>

        <div class="card-body">
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

    <div class="card mt-4">
        <div class="card-header">IIDXMEMOとは？</div>
        <div class="card-body">
            <p>beatmania IIDXのACに収録されている楽曲のメモを気軽に行えるサービスです。</p>
            <ul>
                <li>クリアできそうな曲</li>
                <li>スコアが伸びそうな曲</li>
                <li>好きな曲</li>
                <li>ライブ配信のリクエスト曲</li>
            </ul>
            <p>…などなど、様々な用途でメモをしたくなったときにご利用ください。</p>
        </div>
    </div>
@endsection
