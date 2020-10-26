<div class="modal fade" id="SearchModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="SearchModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" onsubmit="return false;">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="search_version">バージョン</label>
                            <select id="search_version" class="form-control" name="search_version">
                                <option value="">指定なし</option>
                                @foreach (config('const.VERSION') as $key => $version)
                                    <option value="{{ $key }}">{{ $version }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="search_free">フリーワード</label>
                            <input type="text" class="form-control" id="search_free" name="search_free" value="" placeholder="俗称でもある程度検索できます" maxlength="255">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="search_sp_difficulty">SP難易度</label>
                            <select id="search_sp_difficulty" class="form-control" name="search_sp_difficulty">
                                <option value="">指定なし</option>
                                @foreach (config('const.SP_DIFFICULTY') as $key => $sp_difficulty)
                                    <option value="{{ $key }}">{{ $sp_difficulty }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="search_dp_difficulty">DP難易度</label>
                            <select id="search_dp_difficulty" class="form-control" name="search_dp_difficulty">
                                <option value="">指定なし</option>
                                @foreach (config('const.DP_DIFFICULTY') as $key => $dp_difficulty)
                                    <option value="{{ $key }}">{{ $dp_difficulty }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitSearchForm();">検索</button>
                    <div class="border mt-4 mb-4"></div>
                    <div id="scroll-area">
                        <table class="table table-bordered table-hover">
                            <tbody id="music_list">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light w-125px disabled_button" data-dismiss="modal">閉じる</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function submitSearchForm() {
        $('.disabled_button').prop('disabled', true);
        var loading = '';
        loading += '<div class="d-flex justify-content-center" id="loading">';
        loading += '<div class="spinner-border" role="status">';
        loading += '<span class="sr-only">Loading...</span>';
        loading += '</div>';
        loading += '</div>';
        $('#music_list').html(loading);
        $.ajax({
            url: '{{ route('user.memo.search') }}',
            type: 'post',
            cache: false,
            dataType:'json',
            data: {
                '_token': $('input[name="_token"]').val(),
                'version': $('[name=search_version] option:selected').val(),
                'free': $('#search_free').val(),
                'sp_difficulty': $('[name=search_sp_difficulty] option:selected').val(),
                'dp_difficulty': $('[name=search_dp_difficulty] option:selected').val()
            },
        })
            .done(function(response) {
                //通信成功時の処理
                $('#scroll-area').attr('style', 'max-height: 400px; overflow-y: scroll;');
                var html = '';
                $.each(response, function(index, value){
                    html += '<tr>';
                    html += '<td>'+value.title+'</td>';
                    if ($('#registered_music_id_'+value.id).val()) {
                        html += '<td class="w-100px"><button type="button" class="btn btn-info" disabled>登録済</button></td>';
                    } else {
                        html += '<td class="w-100px"><button type="button" id="search_music_id_'+value.id+'" class="btn btn-primary disabled_button" onclick="submitCreateForm('+value.id+');">登録</button></td>';
                    }
                    html += '</tr>';
                });
                $('#loading').remove();
                if (html == '') {
                    html = '<tr><td>検索結果は0件でした。</td></tr>';
                }
                $('#music_list').html(html);

                $('.disabled_button').prop('disabled', false);
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

    function submitCreateForm(music_id) {
        $('.disabled_button').prop('disabled', true);
        $.ajax({
            url: '{{ route('home') }}/user/memo/store/'+music_id,
            type: 'post',
            cache: false,
            dataType:'json',
            data: {
                '_token': $('input[name="_token"]').val(),
            },
        })
            .done(function(response) {
                //通信成功時の処理
                alert(response.messages);
                $('#search_music_id_'+music_id).attr('class', 'btn btn-info').prop('disabled', true).text('登録済');
                getMemo();
                $('.disabled_button').prop('disabled', false);
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
</script>
