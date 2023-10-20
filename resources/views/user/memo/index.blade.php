@extends('user.layouts.index')
@section('title', 'メモ一覧 | IIDXMEMO')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">メモ一覧</li>
        </ol>
    </nav>
    <div class="card mt-3">
        <div class="card-header">
            <button type="button"
                    class="btn btn-primary btn-lg btn-block"
                    data-toggle="collapse"
                    data-target="#search_area"
            >絞り込み</button>
        </div>
        <div class="card-body">
            <form action="" method="POST" onsubmit="return false;">
                @csrf
                <div class="form-group collapse" id="search_area">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-header">バージョン</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">全て選ぶ</button>
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">全て外す</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.VERSION') as $key => $version)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="version_checkbox_{{ $key }}" value="{{ $key }}" checked="checked">
                                                    <label class="form-check-label" for="version_checkbox_{{ $key }}">{{ $version }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="card">
                                <div class="card-header">SP難易度</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">全て選ぶ</button>
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">全て外す</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.SP_DIFFICULTY') as $key => $sp_difficulty)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="sp_difficulty_checkbox_{{ $key }}" value="{{ $key }}" checked="checked">
                                                    <label class="form-check-label" for="sp_difficulty_checkbox_{{ $key }}">{{ $sp_difficulty }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="card">
                                <div class="card-header">DP難易度</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">全て選ぶ</button>
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">全て外す</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.DP_DIFFICULTY') as $key => $dp_difficulty)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="dp_difficulty_checkbox_{{ $key }}" value="{{ $key }}" checked="checked">
                                                    <label class="form-check-label" for="dp_difficulty_checkbox_{{ $key }}">{{ $dp_difficulty }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="card">
                                <div class="card-header">メモの有無</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.SP_DIFFICULTY') as $key => $sp_difficulty)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="memo_radio_{{ $key }}" value="{{ $key }}">
                                                    <label class="form-check-label" for="memo_radio_{{ $key }}">{{ $sp_difficulty }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="card">
                                <div class="card-header">フラグの有無</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.SP_DIFFICULTY') as $key => $sp_difficulty)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="check_flag_radio_{{ $key }}" value="{{ $key }}">
                                                    <label class="form-check-label" for="check_flag_radio_{{ $key }}">{{ $sp_difficulty }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-header">フリーワード</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text"
                                                   class="form-control"
                                                   id="search_free"
                                                   name="search_free"
                                                   value=""
                                                   placeholder="俗称でもある程度検索できます"
                                                   maxlength="255"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
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
    @include('user.memo.modal.search')
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
                    html += '<td class="pointer" onclick="getEditMemo('+value.memo_id+');">';
                    html += value.title;
                    html += '<input type="hidden" id="registered_music_id_'+value.music_id+'" value="'+value.music_id+'">';
                    html += '</td>';
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
                var error_message = '';
                if (xhr.status == 419) {
                    error_message = "一定期間操作されていませんでした。\nブラウザを読み込みしなおしてください。";
                } else {
                    $.each(xhr.responseJSON.errors, function(index, value){
                        error_message = error_message + value + "\n";
                    });
                }
                alert(error_message);
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
                    var error_message = '';
                    if (xhr.status == 419) {
                        error_message = "一定期間操作されていませんでした。\nブラウザを読み込みしなおしてください。";
                    } else {
                        $.each(xhr.responseJSON.errors, function(index, value){
                            error_message = error_message + value + "\n";
                        });
                    }
                    alert(error_message);
                })
                .always(function(xhr, msg) {
                    //結果に関わらず実行したい処理
                });
        }

        function openSearchModal() {
            $('.disabled_button').prop('disabled', false);
            $('#search_version').val('');
            $('#search_free').val('');
            $('#search_sp_difficulty').val('');
            $('#search_dp_difficulty').val('');
            var html = '<tr><td>検索してください。</td></tr>';
            $('#music_list').html(html);
            $('#SearchModal').modal('show');
        }
    </script>
@endsection
