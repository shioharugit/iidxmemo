@extends('user.layouts.index')
@section('title', 'パスワード再設定メール送信 | IIDXMEMO')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">HOME</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.login') }}">ログイン</a></li>
            <li class="breadcrumb-item active" aria-current="page">パスワード再設定メール送信</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header">パスワード再設定メール送信</div>

        <div class="card-body">
            <p>
                パスワードの再設定をするためのメールを送信します。<br>
                {{ config('const.EMAIL_ATTENTION') }}
            </p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('user.password') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control zen2han @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary w-150px">
                            送信
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
