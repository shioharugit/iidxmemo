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
                    class="btn btn-success btn-lg btn-block"
                    data-toggle="collapse"
                    data-target="#search_area"
            >絞り込み</button>
        </div>
        <div class="card-body">
            <form id="search_area_form" action="" method="POST" onsubmit="return false;">
                @csrf
                <div class="form-group collapse" id="search_area">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="card">
                                <div class="card-header">バージョン</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="version_all_select">全て選ぶ</button>
                                            <button type="button" class="btn btn-warning w-125px disabled_button" id="version_all_remove">全て外す</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.VERSION') as $key => $version)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="version_checkbox_{{ $key }}" name="search_version" value="{{ $key }}">
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
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="sp_difficulty_all_select">全て選ぶ</button>
                                            <button type="button" class="btn btn-warning w-125px disabled_button" id="sp_difficulty_all_remove">全て外す</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.SP_DIFFICULTY') as $key => $sp_difficulty)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="sp_difficulty_checkbox_{{ $key }}" name="search_sp_difficulty" value="{{ $key }}">
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
                                            <button type="button" class="btn btn-primary w-125px disabled_button" id="dp_difficulty_all_select">全て選ぶ</button>
                                            <button type="button" class="btn btn-warning w-125px disabled_button" id="dp_difficulty_all_remove">全て外す</button>
                                        </div>
                                        <div class="form-group col-md-12">
                                            @foreach (config('const.DP_DIFFICULTY') as $key => $dp_difficulty)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="dp_difficulty_checkbox_{{ $key }}" name="search_dp_difficulty" value="{{ $key }}">
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
                                            @foreach (config('const.MEMO_RADIO_BUTTON') as $key => $memo_radio)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="search_memo_radio_{{ $key }}" name="search_memo_radio" value="{{ $key }}">
                                                    <label class="form-check-label" for="search_memo_radio_{{ $key }}">{{ $memo_radio }}</label>
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
                                            @foreach (config('const.CHECK_FLAG_RADIO_BUTTON') as $key => $check_flag_radio)
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="search_check_flag_radio_{{ $key }}" name="search_check_flag_radio" value="{{ $key }}">
                                                    <label class="form-check-label" for="search_check_flag_radio_{{ $key }}">{{ $check_flag_radio }}</label>
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
                                                   aria-label="フリーワード"
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
            <div id="loading_area"></div>
            <table class="table table-bordered table-hover">
                <tbody id="memo_list">
                </tbody>
            </table>
        </div>
    </div>
    @include('user.memo.modal.edit')
    <script>
        cookieParamCheck();
        search();

        $('#version_all_select').on('click', function () {
            $("input[name='search_version']").prop('checked', true);
            search();
        });

        $('#version_all_remove').on('click', function () {
            $("input[name='search_version']").prop('checked', false);
            search();
        });

        $('#sp_difficulty_all_select').on('click', function () {
            $("input[name='search_sp_difficulty']").prop('checked', true);
            search();
        });

        $('#sp_difficulty_all_remove').on('click', function () {
            $("input[name='search_sp_difficulty']").prop('checked', false);
            search();
        });

        $('#dp_difficulty_all_select').on('click', function () {
            $("input[name='search_dp_difficulty']").prop('checked', true);
            search();
        });

        $('#dp_difficulty_all_remove').on('click', function () {
            $("input[name='search_dp_difficulty']").prop('checked', false);
            search();
        });

        $('#search_area_form').change(function () {
            search();
        });

        function search() {
            $('#memo_list').empty();
            startLoading();
            getMemo();
        }

        function cookieParamCheck() {
            $.cookie.json = true;
            let cookie_search_params = $.cookie('cookie_search_params_{{Auth::user()->id}}');
            if (cookie_search_params) {
                // クッキーありの場合、クッキーの検索値を画面の検索条件に反映
                if (cookie_search_params.search_version.length !== 0) {
                    $.each(cookie_search_params.search_version, function (index, val) {
                        $("#version_checkbox_" + val).prop('checked', true);
                    });
                }
                if (cookie_search_params.search_sp_difficulty.length !== 0) {
                    $.each(cookie_search_params.search_sp_difficulty, function (index, val) {
                        $("#sp_difficulty_checkbox_" + val).prop('checked', true);
                    });
                }
                if (cookie_search_params.search_dp_difficulty.length !== 0) {
                    $.each(cookie_search_params.search_dp_difficulty, function (index, val) {
                        $("#dp_difficulty_checkbox_" + val).prop('checked', true);
                    });
                }
                if (cookie_search_params.search_memo_radio) {
                    $("#search_memo_radio_" + cookie_search_params.search_memo_radio).prop('checked', true);
                }
                if (cookie_search_params.search_check_flag_radio) {
                    $("#search_check_flag_radio_" + cookie_search_params.search_check_flag_radio).prop('checked', true);
                }
                if (cookie_search_params.search_free) {
                    $("#search_free").val(cookie_search_params.search_free);
                }
            } else {
                // クッキーなしの場合、初期表示を画面の検索条件に反映
                // バージョンは全てにチェック
                $("input[name='search_version']").prop('checked', true);
                // SP難易度は全てにチェック
                $("input[name='search_sp_difficulty']").prop('checked', true);
                // DP難易度は全てにチェック
                $("input[name='search_dp_difficulty']").prop('checked', true);
                // メモの有無は指定なしにチェック
                $('#search_memo_radio_0').prop('checked', true);
                // フラグの有無は指定なしにチェック
                $('#search_check_flag_radio_0').prop('checked', true);
            }
        }

        function startLoading() {
            let html = '';
            html += '<div class="d-flex justify-content-center" id="loading">';
            html += '<div class="spinner-border" role="status">';
            html += '<span class="sr-only">Loading...</span>';
            html += '</div>';
            html += '</div>';
            $('#loading_area').html(html);
        }

        function getMemo() {
            const url = '{{ route('user.memo.list') }}';
            const search_version = $('input[name=search_version]:checked').map(function () {
                return $(this).val();
            }).get();
            const search_sp_difficulty = $('input[name=search_sp_difficulty]:checked').map(function () {
                return $(this).val();
            }).get();
            const search_dp_difficulty = $('input[name=search_dp_difficulty]:checked').map(function () {
                return $(this).val();
            }).get();
            const search_memo_radio = $('input:radio[name="search_memo_radio"]:checked').val();
            const search_check_flag_radio = $('input:radio[name="search_check_flag_radio"]:checked').val();
            const search_free = $('input[name="search_free"]').val();
            const search_params = {
                'search_version': search_version,
                'search_sp_difficulty': search_sp_difficulty,
                'search_dp_difficulty': search_dp_difficulty,
                'search_memo_radio': search_memo_radio,
                'search_check_flag_radio': search_check_flag_radio,
                'search_free': search_free
            };
            $.ajax({
                url: url,
                type: 'post',
                cache: false,
                dataType: 'json',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'search_version': search_version,
                    'search_sp_difficulty': search_sp_difficulty,
                    'search_dp_difficulty': search_dp_difficulty,
                    'search_memo_radio': search_memo_radio,
                    'search_check_flag_radio': search_check_flag_radio,
                    'search_free': search_free
                },
            })
                .done(function (response) {
                    //通信成功時の処理

                    // 検索条件をクッキーに保存
                    $.cookie.json = true;
                    $.cookie('cookie_search_params_{{Auth::user()->id}}', search_params, {expires: 30});

                    // 検索結果の表示
                    let html = '';
                    $.each(response, function (index, value) {
                        html += '<tr class="music-area">';
                        html += '<td class="pointer music-name" onclick="getEditMemo(' + value.memo_id + ');">';
                        if (value.check_flag === 1) {
                            html += '<i class="fa-solid fa-flag mr-2 flag"></i>';
                        }
                        html += value.title;
                        html += '<input type="hidden" id="registered_music_id_' + value.music_id + '" value="' + value.music_id + '">';
                        html += '</td>';
                        html += '</tr>';
                    });
                    $('#loading').remove();
                    if (html === '') {
                        html = '<tr><td>検索結果が0件でした。</td></tr>';
                    }
                    $('#memo_list').html(html);

                    // メモ削除後に一覧を表示する際、Modalを閉じる
                    $('#EditModal').modal('hide');
                })
                .fail(function (xhr) {
                    //通信失敗時の処理
                    let error_message = '';
                    if (xhr.status === 419) {
                        error_message = "一定期間操作されていませんでした。\nブラウザを読み込みしなおしてください。";
                    } else {
                        $.each(xhr.responseJSON.errors, function (index, value) {
                            error_message = error_message + value + "\n";
                        });
                    }
                    alert(error_message);
                })
                .always(function (xhr, msg) {
                    //結果に関わらず実行したい処理
                });
        }

        function getEditMemo(memo_id) {
            $('.disabled_button').prop('disabled', false);
            const url = '{{ route('user.memo.list') }}';
            $.ajax({
                url: url,
                type: 'post',
                cache: false,
                dataType: 'json',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'memo_id': memo_id
                },
            })
                .done(function (response) {
                    //通信成功時の処理
                    $('#memo').remove();
                    $('#display_memo').html('<textarea class="form-control" rows="10" id="memo" name="memo"></textarea>');
                    $.each(response, function (index, value) {
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
                        $("#memo_check_flag_" + value.check_flag).prop('checked', true);
                        $('#memo').text(value.memo);
                    });
                    $('#EditModal').modal('show');
                })
                .fail(function (xhr) {
                    //通信失敗時の処理
                    let error_message = '';
                    if (xhr.status === 419) {
                        error_message = "一定期間操作されていませんでした。\nブラウザを読み込みしなおしてください。";
                    } else {
                        $.each(xhr.responseJSON.errors, function (index, value) {
                            error_message = error_message + value + "\n";
                        });
                    }
                    alert(error_message);
                })
                .always(function (xhr, msg) {
                    //結果に関わらず実行したい処理
                });
        }

        function submitEditForm() {
            $('.disabled_button').prop('disabled', true);
            $.ajax({
                url: '{{ route('home') }}/user/memo/update/' + $('#memo_id').val(),
                type: 'post',
                cache: false,
                dataType: 'json',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'memo_check_flag': $('input:radio[name="memo_check_flag"]:checked').val(),
                    'memo': $('#memo').val(),
                },
            })
                .done(function (response) {
                    //通信成功時の処理
                    alert(response.messages);
                    search();
                    $('.disabled_button').prop('disabled', false);
                })
                .fail(function (xhr) {
                    //通信失敗時の処理
                    let error_message = '';
                    if (xhr.status === 419) {
                        error_message = "一定期間操作されていませんでした。\nブラウザを読み込みしなおしてください。";
                    } else {
                        $.each(xhr.responseJSON.errors, function (index, value) {
                            error_message = error_message + value + "\n";
                        });
                    }
                    alert(error_message);
                })
                .always(function (xhr, msg) {
                    //結果に関わらず実行したい処理
                });
        }
    </script>
@endsection
