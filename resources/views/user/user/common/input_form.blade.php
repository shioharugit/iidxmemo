@if ($type === 'create')
    @php $action_url = route('user.store', $email_verify_token ?? ''); @endphp
@else
    @php $action_url = route('user.update'); @endphp
@endif
@if (!empty($invalid_message))
    <div class="card">
        <h5 class="card-header">URLが無効です</h5>
        <div class="card-body">
            <div class="mb-3 collapse show">
                <div class="alert alert-danger" role="alert">
                    このURLは無効です。URLに間違いがないか、お確かめください。
                </div>
            </div>
        </div>
    </div>
@else
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.memo.index') }}">メモ一覧</a></li>
            <li class="breadcrumb-item active" aria-current="page">ユーザー更新</li>
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
                            <div>{{$user->email ?? '' }}</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="login_id">ログインID</label>
                            <input type="text"
                                   name="login_id"
                                   id="login_id"
                                   class="form-control zen2han @error('login_id') is-invalid @enderror"
                                   value="{{ old('login_id') ? old('login_id') : $user->login_id ?? '' }}"
                                   maxlength="20">
                            @if(!empty($errors->first('login_id')))
                                <span class="text-danger"><strong>{{$errors->first('login_id')}}</strong></span><br>
                            @endif
                            <small class="text-muted">
                                ※半角英数字記号(_-@)6文字以上20文字以内で入力してください。
                            </small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">パスワード</label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="form-control zen2han @error('password') is-invalid @enderror"
                                   value=""
                                   maxlength="20">
                            @if(!empty($errors->first('password')))
                                <span class="text-danger"><strong>{{$errors->first('password')}}</strong></span><br>
                            @endif
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">パスワード（確認）</label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   value=""
                                   maxlength="20">
                            @if(!empty($errors->first('password_confirmation')))
                                <span class="text-danger"><strong>{{$errors->first('password_confirmation')}}</strong></span><br>
                            @endif
                            <small class="text-muted">
                                ※8文字以上20文字以内で入力してください。<br>
                                ※他のシステムで使用しているパスワードを使用しないようにしてください。
                            </small>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary m-2 w-150px disabled_button" onclick="submitInputForm()">{{ $type === 'create' ? '登録' : '更新' }}</button>
                    @if ($type === 'edit')
                        <button type="button" class="btn btn-danger m-2 w-150px disabled_button" onclick="submitDeleteForm()">退会</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script>
        function submitInputForm() {
            var confirm_type = '{{ $type === 'create' ? '登録' : '更新' }}';
            if (confirm('こちらの内容で'+confirm_type+'します。よろしいですか？')) {
                $('.disabled_button').prop('disabled', true);
                $('#input_form').attr('action', '{{ $action_url }}');
                $('#input_form').submit();
            } else {
                return false;
            }
        }
        @if ($type === 'edit')
        function submitDeleteForm() {
            if (confirm("ユーザーを削除し、退会しますか？\n※退会した場合、今までのメモが削除されログインができなくなります。")) {
                if (confirm("退会します。\n退会処理を進める場合OKを押してください。")) {
                    $('.disabled_button').prop('disabled', true);
                    $('#input_form').attr('action', '{{route('user.destroy', $user->id)}}');
                    $('#input_form').submit();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        @endif
    </script>
@endif
