<div class="modal fade" id="EditModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="POST" onsubmit="return false;">
                @csrf
                <input type="hidden" id="memo_id" name="memo_id" value="">
                <div class="modal-header">
                    <div class="modal-title" id="modal_title"></div>
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
                        <div class="col-sm-2 col-form-label font-weight-bold">SP難易度</div>
                        <div class="col-sm-10 h4 row">
                            <div class="beginner col text-center" id="memo_sp_beginner"></div>
                            <div class="normal col text-center" id="memo_sp_normal"></div>
                            <div class="hyper col text-center" id="memo_sp_hyper"></div>
                            <div class="another col text-center" id="memo_sp_another"></div>
                            <div class="leggendaria col text-center" id="memo_sp_leggendaria"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label font-weight-bold">DP難易度</div>
                        <div class="col-sm-10 h4 row">
                            <div class="beginner col text-center" id="memo_dp_beginner"></div>
                            <div class="normal col text-center" id="memo_dp_normal"></div>
                            <div class="hyper col text-center" id="memo_dp_hyper"></div>
                            <div class="another col text-center" id="memo_dp_another"></div>
                            <div class="leggendaria col text-center" id="memo_dp_leggendaria"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label font-weight-bold">フラグ</div>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="memo_check_flag_{{config('const.FLAG_ON')}}" name="memo_check_flag" value="{{config('const.FLAG_ON')}}">
                                <label class="form-check-label" for="memo_check_flag_{{config('const.FLAG_ON')}}">オン</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="memo_check_flag_{{config('const.FLAG_OFF')}}" name="memo_check_flag" value="{{config('const.FLAG_OFF')}}">
                                <label class="form-check-label" for="memo_check_flag_{{config('const.FLAG_OFF')}}">オフ</label>
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
                    <button type="button" class="btn btn-light w-125px disabled_button" data-dismiss="modal">閉じる</button>
                </div>
            </form>
        </div>
    </div>
</div>
