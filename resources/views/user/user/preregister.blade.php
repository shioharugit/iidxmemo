@extends('user.layouts.index')
@section('title', 'ユーザー新規登録')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.login') }}">ログイン</a></li>
            <li class="breadcrumb-item active" aria-current="page">ユーザー新規登録</li>
        </ol>
    </nav>

    <div class="card">
        <h5 class="card-header">ユーザー新規登録</h5>

        <div class="card-body">
            <p>
                ユーザーの新規登録をするためのメールを送信します。<br>
                1人のユーザーは1つのメールアドレスのみ使用可能です。<br>
                特定のメールアドレスのみを受信可能にしている場合、「example.com」からのメールを受信可能とするよう設定してください。
            </p>
            @if (!empty(session('messages')))
                <div class="alert alert-success" role="alert">
                    @foreach (session('messages') as $message)
                        {{ $message }}<br>
                        @php session()->forget('messages'); @endphp
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('user.send') }}" id="input_form">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">メールアドレス</label>
                        <input type="text" name="email" id="email" class="form-control zen2han @error('email') is-invalid @enderror" placeholder="メールアドレスを入力してください" value="{{ old('email') ? old('email') : $sub_user->email ?? '' }}">
                        @if(!empty($errors->first('email')))
                            <span class="text-danger"><strong>{!! $errors->first('email') !!}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email_confirmation">メールアドレス（確認）</label>
                        <input type="text" name="email_confirmation" id="email_confirmation" class="form-control zen2han @error('email_confirmation') is-invalid @enderror" placeholder="メールアドレスを入力してください" value="{{ old('email_confirmation') ? old('email_confirmation') : $sub_user->email ?? '' }}">
                        @if(!empty($errors->first('email_confirmation')))
                            <span class="text-danger"><strong>{{$errors->first('email_confirmation')}}</strong></span>
                        @endif
                    </div>
                </div>

                <button type="button" class="btn btn-primary m-2 w-150px disabled_button" onclick="submitInputForm()">送信</button>
            </form>
        </div>
    </div>
    <script>
        function submitInputForm() {
            $('.disabled_button').prop('disabled', true);
            $('#input_form').submit();
        }
    </script>
@endsection
