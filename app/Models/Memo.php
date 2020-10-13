<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class Memo extends Model
{
    protected $table = 'memos';

    /**
     * メモを取得する
     * @param $params
     * @return mixed
     */
    public function getMemo($params)
    {
        $query = Memo::select('*');

        if (!empty($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        return $query->get();
    }

    /**
     * メモ登録処理
     * @param $data
     * @return mixed
     */
    public function createMemo($data)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $result = Memo::insert($data);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('メモ登録中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }

    /**
     * メモ更新処理
     * @param $data
     * @param $where
     * @return mixed
     */
    public function updateMemo($data, $where)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $query = Memo::query();

            if (!empty($where['user_id'])) {
                $query->where('user_id', '=', $where['user_id']);
            }

            if (!empty($where['music_id'])) {
                $query->where('music_id', '=', $where['music_id']);
            }

            $result = $query->update($data);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('メモ更新中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }
}
