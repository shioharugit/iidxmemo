<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">ユーザー一覧</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @if ($type === 'create')
                ユーザー登録
            @else
                ユーザー更新
            @endif
        </li>
    </ol>
</nav>

<div class="card">
    <h5 class="card-header">{{$title}}</h5>
    <div class="card-body">
        <div class="mb-3 collapse show">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="" method="POST" id="input_form">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">メールアドレス</label>
                        <input type="text" name="email" id="email" class="form-control zen2han @error('email') is-invalid @enderror" placeholder="メールアドレスを入力してください" value="{{ old('email') ? old('email') : $user->email ?? '' }}">
                        @if(!empty($errors->first('email')))
                            <span class="text-danger"><strong>{!! $errors->first('email') !!}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email_confirmation">メールアドレス（確認）</label>
                        <input type="text" name="email_confirmation" id="email_confirmation" class="form-control zen2han @error('email_confirmation') is-invalid @enderror" placeholder="メールアドレスを入力してください" value="{{ old('email_confirmation') ? old('email_confirmation') : $user->email ?? '' }}">
                        @if(!empty($errors->first('email_confirmation')))
                            <span class="text-danger"><strong>{{$errors->first('email_confirmation')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="login_id">ログインID</label>
                        <input type="text"
                               name="login_id"
                               id="login_id"
                               class="form-control zen2han @error('login_id') is-invalid @enderror"
                               placeholder="半角英数字記号(_-@)6文字以上20文字以内で入力してください。"
                               value="{{ old('login_id') ? old('login_id') : $user->login_id ?? '' }}"
                               maxlength="20">
                        @if(!empty($errors->first('login_id')))
                            <span class="text-danger"><strong>{{$errors->first('login_id')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">パスワード</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control zen2han @error('password') is-invalid @enderror"
                               placeholder="半角英数字記号(_-@)6文字以上20文字以内で入力してください。"
                               value="">
                        @if(!empty($errors->first('password')))
                            <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span><br>
                        @endif
                        <small class="text-muted">
                            ※他のシステムで使用しているパスワードを使用しないようにしてください。
                        </small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password_confirmation">パスワード（確認）</label>
                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               placeholder="誤入力防止のため上記と同じものを入力してください。"
                               value="">
                        @if(!empty($errors->first('password_confirmation')))
                            <span class="text-danger"><strong>{{$errors->first('password_confirmation')}}</strong></span>
                        @endif
                    </div>
                </div>

                <button type="button" class="btn btn-primary m-2 w-150px disabled_button" onclick="submitInputForm()">{{ $type === 'create' ? '登録' : '更新' }}</button>
                <a href="{{route('admin.user.index')}}" class="btn btn-light m-2 w-150px">戻る</a>
                @if ($type === 'edit')
                    <button type="button" class="btn btn-danger m-2 w-150px disabled_button" onclick="submitDeleteForm()">削除</button>
                @endif
            </form>
        </div>
    </div>
</div>
<script>
    function submitInputForm() {
        var confirm_type = '{{ $type === 'create' ? '登録' : '更新' }}';
        if (confirm('この内容で'+confirm_type+'します。よろしいですか？')) {
            $('.disabled_button').prop('disabled', true);
            $('#input_form').attr('action', '{{ $type === 'create' ? route('admin.user.store') : route('admin.user.update', $user->id) }}');
            $('#input_form').submit();
        } else {
            return false;
        }
    }
    @if ($type === 'edit')
        function submitDeleteForm() {
            if (confirm('ユーザーを削除しますか？')) {
                $('.disabled_button').prop('disabled', true);
                $('#input_form').attr('action', '{{route('admin.user.destroy', $user->id)}}');
                $('#input_form').submit();
            } else {
                return false;
            }
        }
    @endif
</script>
