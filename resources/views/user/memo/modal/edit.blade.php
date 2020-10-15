<div class="modal fade" id="EditModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <input type="hidden" id="memo_id" name="memo_id" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="memo_version" class="col-sm-2 col-form-label font-weight-bold">バージョン</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="memo_version" name="version" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo_genre" class="col-sm-2 col-form-label font-weight-bold">ジャンル</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="memo_genre" name="genre" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo_title" class="col-sm-2 col-form-label font-weight-bold">タイトル</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="memo_title" name="title" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo_artist" class="col-sm-2 col-form-label font-weight-bold">アーティスト</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="memo_artist" name="artist" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo_bpm" class="col-sm-2 col-form-label font-weight-bold">BPM</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="memo_bpm" name="bpm" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo_sp_beginner" class="col-sm-2 col-form-label font-weight-bold">SP難易度</label>
                        <div class="col-sm-10">
                            <div class="h4">
                                <label class="beginner" id="memo_sp_beginner"></label> / <label class="normal" id="memo_sp_normal"></label> / <label class="hyper" id="memo_sp_hyper"></label> / <label class="another" id="memo_sp_another"></label> / <label class="leggendaria" id="memo_sp_leggendaria"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo_sp_beginner" class="col-sm-2 col-form-label font-weight-bold">DP難易度</label>
                        <div class="col-sm-10">
                            <div class="h4">
                                <label class="beginner" id="memo_dp_beginner"></label> / <label class="normal" id="memo_dp_normal"></label> / <label class="hyper" id="memo_dp_hyper"></label> / <label class="another" id="memo_dp_another"></label> / <label class="leggendaria" id="memo_dp_leggendaria"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="memo" class="col-sm-2 col-form-label font-weight-bold">メモ</label>
                        <div class="col-sm-10" id="display_memo">
                            <textarea class="form-control" rows="10" id="memo" name="memo"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-125px disabled_button" id="submit_button" onclick="submitEditForm();">更新</button>
                    <button type="button" class="btn btn-danger w-125px disabled_button" id="submit_button" onclick="submitDeleteForm();">削除</button>
                    <button type="button" class="btn btn-light w-125px disabled_button" data-dismiss="modal">キャンセル</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function submitEditForm() {
        $('.disabled_button').prop('disabled', true);
        $.ajax({
            url: '/user/memo/update/'+$('#memo_id').val(),
            type: 'post',
            cache: false,
            dataType:'json',
            data: {
                '_token': $('input[name="_token"]').val(),
                'memo': $('#memo').val(),
            },
        })
            .done(function(response) {
                //通信成功時の処理
                alert(response.messages);
                $('.disabled_button').prop('disabled', false);
            })
            .fail(function(xhr) {
                //通信失敗時の処理
                var error_message = '';
                $.each(xhr.responseJSON.errors, function(index, value){
                    error_message = error_message + value + "\n";
                });
                alert(error_message);
            })
            .always(function(xhr, msg) {
                //結果に関わらず実行したい処理
            });
    }

    function submitDeleteForm() {
        var alert_message = "メモを一覧から削除しますか？\n※メモを再登録したときに最後に更新した状態のメモを見ることができます。"
        if (confirm(alert_message)) {
            $('.disabled_button').prop('disabled', true);
            $.ajax({
                url: '/user/memo/destroy/'+$('#memo_id').val(),
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
                    getMemo();
                })
                .fail(function(xhr) {
                    //通信失敗時の処理
                    var error_message = '';
                    $.each(xhr.responseJSON.errors, function(index, value){
                        error_message = error_message + value + "\n";
                    });
                    alert(error_message);
                })
                .always(function(xhr, msg) {
                    //結果に関わらず実行したい処理
                });
        } else {
            return false;
        }
    }
</script>
