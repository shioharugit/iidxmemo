<?php

namespace App\Services\User;

use App\Models\Memo as Memo;
use Illuminate\Support\Facades\Auth;

class MemoService
{
    private $memo;

    public function __construct()
    {
        $this->memo = new Memo();
    }

    /**
     * ユーザーのメモを取得する
     * @param $request
     * @return mixed
     */
    public function getMemo($request)
    {
        $params = [
            'user_id' => Auth::user()->id,
            'memo_id' => $request->memo_id,
            'deleted_at_is_null' => true,
        ];

        return $this->memo->getMemo($params);
    }

    /**
     * ユーザーの更新しようとしているメモを取得する
     * @param $memo_id
     * @return mixed
     */
    public function getEditMemo($memo_id)
    {
        $params = [
            'user_id' => Auth::user()->id,
            'memo_id' => $memo_id,
            'deleted_at_is_null' => true,
        ];

        return $this->memo->getMemo($params);
    }

    /**
     * メモ更新処理
     * @param $request
     * @param $memo_id
     * @return mixed
     */
    public function updateMemo($request, $memo_id)
    {
        $data = [
            'memo' => $request->memo,
        ];

        $where = [
            'id' => $memo_id,
            'user_id' => Auth::user()->id,
        ];

        return $this->memo->updateMemo($data, $where);
    }

    /**
     * メモ削除処理
     * @param $memo_id
     * @return mixed
     */
    public function deleteMemo($memo_id)
    {
        $data = [
            'deleted_at' => date(config('const.DEFAULT_DATE_FORMAT'))
        ];

        $where = [
            'id' => $memo_id,
            'user_id' => Auth::user()->id,
        ];

        return $this->memo->updateMemo($data, $where);
    }
}
