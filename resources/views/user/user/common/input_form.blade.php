@if ($type === 'create')
    @php $action_url = route('user.store', $email_verify_token); @endphp
@else
    @php $action_url = route('user.sub_user.update', $sub_user->danka_user_id); @endphp
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
    <div class="card">
        <h5 class="card-header">{{$title}}</h5>
        <div class="card-body">
            <div class="mb-3 collapse show">
                @if (!empty(session('messages')))
                    <div class="alert alert-success" role="alert">
                        @foreach (session('messages') as $message)
                            {{ $message }}<br>
                        @endforeach
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
                                   placeholder="半角英数字記号(_-@)6文字以上20文字以内で入力してください。"
                                   value="{{ old('login_id') ? old('login_id') : $sub_user->login_id ?? '' }}"
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

                    <button type="button" class="btn btn-primary m-2 w-150px disabled_button" onclick="submitInputForm()">{{ $type === 'create' ? '登録' : '修正' }}</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function submitInputForm() {
            var confirm_type = '{{ $type === 'create' ? '登録' : '修正' }}';
            if (confirm('こちらの内容で'+confirm_type+'します。よろしいですか？')) {
                $('.disabled_button').prop('disabled', true);
                $('#input_form').attr('action', '{{ $action_url }}');
                $('#input_form').submit();
            } else {
                return false;
            }
        }
    </script>
@endif
