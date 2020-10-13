<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.music.index') }}">楽曲一覧</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            @if ($type === 'create')
                楽曲登録
            @else
                楽曲更新
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
                        <label for="version">バージョン</label>
                        <select id="version" class="form-control @error('version') is-invalid @enderror" name="version">
                            @php
                                $music_version = old('version') ? old('version') : $music->version ?? '' ;
                                $versions = config('const.VERSION');
                                krsort($versions);
                            @endphp
                            @foreach ($versions as $key => $version)
                                <option value="{{ $key }}" {{ (string)$music_version === (string)$key ? 'selected' : '' }}>{{ $version }}</option>
                            @endforeach
                        </select>
                        @if(!empty($errors->first('version')))
                            <span class="text-danger"><strong>{{$errors->first('version')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title">タイトル</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $music->title ?? '' }}" maxlength="255">
                        @if(!empty($errors->first('title')))
                            <span class="text-danger"><strong>{{$errors->first('title')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="genre">ジャンル</label>
                        <input type="text" name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre') ? old('genre') : $music->genre ?? '' }}" maxlength="255">
                        @if(!empty($errors->first('genre')))
                            <span class="text-danger"><strong>{{$errors->first('genre')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="artist">アーティスト</label>
                        <input type="text" name="artist" id="artist" class="form-control @error('artist') is-invalid @enderror" value="{{ old('artist') ? old('artist') : $music->artist ?? '' }}" maxlength="255">
                        @if(!empty($errors->first('artist')))
                            <span class="text-danger"><strong>{{$errors->first('artist')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="bpm">BPM</label>
                        <input type="text" name="bpm" id="bpm" class="form-control @error('bpm') is-invalid @enderror" value="{{ old('bpm') ? old('bpm') : $music->bpm ?? '' }}" maxlength="255">
                        @if(!empty($errors->first('bpm')))
                            <span class="text-danger"><strong>{{$errors->first('bpm')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="popular_name">俗称</label>
                        <input type="text" name="popular_name" id="popular_name" class="form-control @error('popular_name') is-invalid @enderror" value="{{ old('popular_name') ? old('popular_name') : $music->popular_name ?? '' }}" maxlength="255">
                        @if(!empty($errors->first('popular_name')))
                            <span class="text-danger"><strong>{{$errors->first('popular_name')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="sp_beginner">SP難易度</label>
                        <input type="text" name="sp_beginner" id="sp_beginner" class="form-control zen2han @error('sp_beginner') is-invalid @enderror" placeholder="BEGINNER" value="{{ old('sp_beginner') ? old('sp_beginner') : $music->sp_beginner ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('sp_beginner')))
                            <span class="text-danger"><strong>{{$errors->first('sp_beginner')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sp_normal">&emsp;</label>
                        <input type="text" name="sp_normal" id="sp_normal" class="form-control zen2han @error('sp_normal') is-invalid @enderror" placeholder="NORMAL" value="{{ old('sp_normal') ? old('sp_normal') : $music->sp_normal ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('sp_normal')))
                            <span class="text-danger"><strong>{{$errors->first('sp_normal')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sp_hyper">&emsp;</label>
                        <input type="text" name="sp_hyper" id="sp_hyper" class="form-control zen2han @error('sp_hyper') is-invalid @enderror" placeholder="HYPER" value="{{ old('sp_hyper') ? old('sp_hyper') : $music->sp_hyper ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('sp_hyper')))
                            <span class="text-danger"><strong>{{$errors->first('sp_hyper')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sp_another">&emsp;</label>
                        <input type="text" name="sp_another" id="sp_another" class="form-control zen2han @error('sp_another') is-invalid @enderror" placeholder="ANOTHER" value="{{ old('sp_another') ? old('sp_another') : $music->sp_another ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('sp_another')))
                            <span class="text-danger"><strong>{{$errors->first('sp_another')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sp_leggendaria">&emsp;</label>
                        <input type="text" name="sp_leggendaria" id="sp_leggendaria" class="form-control zen2han @error('sp_leggendaria') is-invalid @enderror" placeholder="LEGGENDARIA" value="{{ old('sp_leggendaria') ? old('sp_leggendaria') : $music->sp_leggendaria ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('sp_leggendaria')))
                            <span class="text-danger"><strong>{{$errors->first('sp_leggendaria')}}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="dp_beginner">DP難易度</label>
                        <input type="text" name="dp_beginner" id="dp_beginner" class="form-control zen2han @error('dp_beginner') is-invalid @enderror" placeholder="BEGINNER" value="{{ old('dp_beginner') ? old('dp_beginner') : $music->dp_beginner ?? '' }}" maxlength="2" readonly>
                        @if(!empty($errors->first('dp_beginner')))
                            <span class="text-danger"><strong>{{$errors->first('dp_beginner')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dp_normal">&emsp;</label>
                        <input type="text" name="dp_normal" id="dp_normal" class="form-control zen2han @error('dp_normal') is-invalid @enderror" placeholder="NORMAL" value="{{ old('dp_normal') ? old('dp_normal') : $music->dp_normal ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('dp_normal')))
                            <span class="text-danger"><strong>{{$errors->first('dp_normal')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dp_hyper">&emsp;</label>
                        <input type="text" name="dp_hyper" id="dp_hyper" class="form-control zen2han @error('dp_hyper') is-invalid @enderror" placeholder="HYPER" value="{{ old('dp_hyper') ? old('dp_hyper') : $music->dp_hyper ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('dp_hyper')))
                            <span class="text-danger"><strong>{{$errors->first('dp_hyper')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dp_another">&emsp;</label>
                        <input type="text" name="dp_another" id="dp_another" class="form-control zen2han @error('dp_another') is-invalid @enderror" placeholder="ANOTHER" value="{{ old('dp_another') ? old('dp_another') : $music->dp_another ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('dp_another')))
                            <span class="text-danger"><strong>{{$errors->first('dp_another')}}</strong></span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dp_leggendaria">&emsp;</label>
                        <input type="text" name="dp_leggendaria" id="dp_leggendaria" class="form-control zen2han @error('dp_leggendaria') is-invalid @enderror" placeholder="LEGGENDARIA" value="{{ old('dp_leggendaria') ? old('dp_leggendaria') : $music->dp_leggendaria ?? '' }}" maxlength="2">
                        @if(!empty($errors->first('dp_leggendaria')))
                            <span class="text-danger"><strong>{{$errors->first('dp_leggendaria')}}</strong></span>
                        @endif
                    </div>
                </div>

                <button type="button" class="btn btn-primary m-2 w-150px disabled_button" onclick="submitInputForm()">{{ $type === 'create' ? '登録' : '更新' }}</button>
                <a href="{{route('admin.music.index')}}" class="btn btn-light m-2 w-150px">戻る</a>
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
            $('#input_form').attr('action', '{{ $type === 'create' ? route('admin.music.store') : route('admin.music.update', $music->id) }}');
            $('#input_form').submit();
        } else {
            return false;
        }
    }
    @if ($type === 'edit')
        function submitDeleteForm() {
            if (confirm('楽曲を削除しますか？')) {
                $('.disabled_button').prop('disabled', true);
                $('#input_form').attr('action', '{{route('admin.music.destroy', $music->id)}}');
                $('#input_form').submit();
            } else {
                return false;
            }
        }
    @endif
</script>
