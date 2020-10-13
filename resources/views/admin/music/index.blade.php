@extends('admin.layouts.index')
@section('title', '楽曲一覧')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">楽曲一覧</li>
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
                <form action="{{ route('admin.music.index') }}" method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{old('title') ? old('title') : $request->input('title')}}" maxlength="255">
                            @if(!empty($errors->first('title')))
                                <span class="text-danger"><strong>{{$errors->first('title')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="genre">ジャンル</label>
                            <input type="text" class="form-control" id="genre" name="genre" value="{{old('genre') ? old('genre') : $request->input('genre')}}" maxlength="255">
                            @if(!empty($errors->first('genre')))
                                <span class="text-danger"><strong>{{$errors->first('genre')}}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="artist">アーティスト</label>
                            <input type="text" class="form-control" id="artist" name="artist"  value="{{old('artist') ? old('artist') : $request->input('artist')}}" maxlength="255">
                            @if(!empty($errors->first('artist')))
                                <span class="text-danger"><strong>{{$errors->first('artist')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="version">バージョン</label>
                            <select id="version" class="form-control" name="version">
                                <option value="">選択してください</option>
                                @foreach (config('const.VERSION') as $key => $version)
                                    <option value="{{ $key }}" {{ (string)$request->input('version') === (string)$key ? 'selected' : '' }}>{{ $version }}</option>
                                @endforeach
                            </select>
                            @if(!empty($errors->first('version')))
                                <span class="text-danger"><strong>{{$errors->first('version')}}</strong></span>
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
                @foreach ($musics as $key => $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td><a class="" style="display:block;" href="{{route('admin.music.edit', $value->id)}}" >{{$value->title}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="paginate">
                {{ $musics->appends([
                    'title' => $request->input('title'),
                    'genre' => $request->input('genre'),
                    'artist' => $request->input('artist'),
                    'version' => $request->input('version'),
                    ])->render() }}
            </div>
            @if (count($musics) === 0)
                <p>検索結果0件でした</p>
            @endif
            <a href="{{ route('admin.music.create') }}" class="btn btn-primary m-2 w-150px">登録</a>
        </div>
    </div>
@endsection
