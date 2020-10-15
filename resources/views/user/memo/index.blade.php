@extends('user.layouts.index')
@section('title', 'メモ一覧')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">メモ一覧</li>
        </ol>
    </nav>
    <div class="card mt-3">
        <h5 class="card-header"><button type="button" class="btn btn-primary w-150px" onclick="openSearchModal();">楽曲検索</button></h5>
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
