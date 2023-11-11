@extends('admin.layouts.index')
@section('title', 'ユーザー一覧')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">ユーザー一覧</li>
        </ol>
    </nav>
    <div class="card">
        <h5 class="card-header">検索条件</h5>
        <div class="card-body">
            <div class="mb-3 collapse show">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('admin.user.index') }}" method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="login_id">ログインID</label>
                            <input type="text" class="form-control zen2han" id="login_id" name="login_id" value="{{old('login_id') ? old('title') : $request->input('login_id')}}" maxlength="20">
                            @if(!empty($errors->first('login_id')))
                                <span class="text-danger"><strong>{{$errors->first('login_id')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control zen2han" id="email" name="email" value="{{old('email') ? old('email') : $request->input('email')}}" maxlength="255" autocomplete="off">
                            @if(!empty($errors->first('email')))
                                <span class="text-danger"><strong>{{$errors->first('email')}}</strong></span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-150px">検索</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <h5 class="card-header">検索結果</h5>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $key => $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td><a class="" style="display:block;" href="{{route('admin.user.edit', $value->id)}}" >{{$value->login_id}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="paginate">
                {{ $users->appends([
                    'login_id' => $request->input('login_id'),
                    'email' => $request->input('email'),
                    ])->render() }}
            </div>
            @if (count($users) === 0)
                <p>検索結果0件でした</p>
            @endif
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary m-2 w-150px">登録</a>
        </div>
    </div>
@endsection
