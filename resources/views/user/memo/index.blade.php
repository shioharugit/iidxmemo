@extends('user.layouts.index')
@section('title', 'メモ一覧')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">メモ一覧</li>
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
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" value="" maxlength="255">
                            @if(!empty($errors->first('title')))
                                <span class="text-danger"><strong>{{$errors->first('title')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="genre">ジャンル</label>
                            <input type="text" class="form-control" id="genre" name="genre" value="" maxlength="255">
                            @if(!empty($errors->first('genre')))
                                <span class="text-danger"><strong>{{$errors->first('genre')}}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="artist">アーティスト</label>
                            <input type="text" class="form-control" id="artist" name="artist"  value="" maxlength="255">
                            @if(!empty($errors->first('artist')))
                                <span class="text-danger"><strong>{{$errors->first('artist')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="version">バージョン</label>
                            <select id="version" class="form-control" name="version">
                                <option value="">選択してください</option>
                                @foreach (config('const.VERSION') as $key => $version)
                                    <option value="{{ $key }}">{{ $version }}</option>
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
        <h5 class="card-header">メモ一覧</h5>
        <div class="card-body">
            <div class="d-flex justify-content-center" id="loading">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <table class="table table-bordered table-hover">
                <tbody id="memo_list">
                </tbody>
            </table>
        </div>
    </div>
    @include('user.memo.modal.edit')
    <script>
        getMemo();

        function getMemo() {
            var url = '{{ route('user.memo.list') }}';
            $.ajax({
                url: url,
                type: 'post',
                cache: false,
                dataType:'json',
                data: {
                    '_token': $('input[name="_token"]').val()
                },
            })
            .done(function(response) {
                //通信成功時の処理
                var html = '';
                $.each(response, function(index, value){
                    html += '<tr>';
                    html += '<td class="pointer" onclick="getEditMemo('+value.memo_id+');">'+value.title+'</td>';
                    html += '</tr>';
                });
                $('#loading').remove();
                if (html == '') {
                    html = '<tr><td>メモが登録されていません。</td></tr>';
                }
                $('#memo_list').html(html);

                // メモ削除後に一覧を表示する際、Modalを閉じる
                $('#EditModal').modal('hide');
            })
            .fail(function(xhr) {
                //通信失敗時の処理
                console.log(xhr);
            })
            .always(function(xhr, msg) {
                //結果に関わらず実行したい処理
            });
        }

        function getEditMemo(memo_id) {
            $('.disabled_button').prop('disabled', false);
            var url = '{{ route('user.memo.list') }}';
            $.ajax({
                url: url,
                type: 'post',
                cache: false,
                dataType:'json',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'memo_id': memo_id
                },
            })
                .done(function(response) {
                    //通信成功時の処理
                    $('#memo').remove();
                    $('#display_memo').html('<textarea class="form-control" rows="10" id="memo" name="memo"></textarea>');
                    $.each(response, function(index, value) {
                        switch (value.version) {
                        @foreach (config('const.VERSION') as $key => $version)
                            case '{{$key}}' :
                            value.version = '{{$version}}';
                            break;
                        @endforeach
                        }
                        $('#memo_id').val(value.memo_id);
                        $('#memo_version').val(value.version);
                        $('#memo_genre').val(value.genre);
                        $('#memo_title').val(value.title);
                        $('#memo_artist').val(value.artist);
                        $('#memo_bpm').val(value.bpm);
                        if (value.sp_beginner == null) {
                            value.sp_beginner = '-';
                        }
                        $('#memo_sp_beginner').text(value.sp_beginner);
                        if (value.sp_normal == null) {
                            value.sp_normal = '-';
                        }
                        $('#memo_sp_normal').text(value.sp_normal);
                        if (value.sp_hyper == null) {
                            value.sp_hyper = '-';
                        }
                        $('#memo_sp_hyper').text(value.sp_hyper);
                        if (value.sp_another == null) {
                            value.sp_another = '-';
                        }
                        $('#memo_sp_another').text(value.sp_another);
                        if (value.sp_leggendaria == null) {
                            value.sp_leggendaria = '-';
                        }
                        $('#memo_sp_leggendaria').text(value.sp_leggendaria);
                        if (value.dp_beginner == null) {
                            value.dp_beginner = '-';
                        }
                        $('#memo_dp_beginner').text(value.dp_beginner);
                        if (value.dp_normal == null) {
                            value.dp_normal = '-';
                        }
                        $('#memo_dp_normal').text(value.dp_normal);
                        if (value.dp_hyper == null) {
                            value.dp_hyper = '-';
                        }
                        $('#memo_dp_hyper').text(value.dp_hyper);
                        if (value.dp_another == null) {
                            value.dp_another = '-';
                        }
                        $('#memo_dp_another').text(value.dp_another);
                        if (value.dp_leggendaria == null) {
                            value.dp_leggendaria = '-';
                        }
                        $('#memo_dp_leggendaria').text(value.dp_leggendaria);
                        $('#memo').text(value.memo);
                    });
                    $('#EditModal').modal('show');
                })
                .fail(function(xhr) {
                    //通信失敗時の処理
                    console.log(xhr);
                })
                .always(function(xhr, msg) {
                    //結果に関わらず実行したい処理
                });
        }
    </script>
@endsection
