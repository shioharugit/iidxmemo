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
        $query = Memo::select(
            'memos.id AS memo_id',
            'memos.user_id',
            'memos.music_id',
            'memos.memo',
            'musics.version',
            'musics.title',
            'musics.genre',
            'musics.artist',
            'musics.bpm',
            'musics.popular_name',
            'musics.sp_beginner',
            'musics.sp_normal',
            'musics.sp_hyper',
            'musics.sp_another',
            'musics.sp_leggendaria',
            'musics.dp_beginner',
            'musics.dp_normal',
            'musics.dp_hyper',
            'musics.dp_another',
            'musics.dp_leggendaria',
        )
            ->leftJoin('musics', function ($join) {
                $join->on('memos.music_id', '=', 'musics.id')
                    ->whereNull('musics.deleted_at');
            });

        if (!empty($params['memo_id'])) {
            $query->where('memos.id', '=', $params['memo_id']);
        }

        if (!empty($params['user_id'])) {
            $query->where('memos.user_id', '=', $params['user_id']);
        }

        if (!empty($params['music_id'])) {
            $query->where('memos.music_id', '=', $params['music_id']);
        }

        if (!empty($params['deleted_at_is_null'])) {
            $query->whereNull('memos.deleted_at');
        }

        if (!empty($params['order_by']['column']) && !empty($params['order_by']['sort'])) {
            $query->orderBy($params['order_by']['column'], $params['order_by']['sort']);
        } else {
            $query->orderBy('memos.id', 'DESC');
        }

        if (!empty($params['paginate'])) {
            return $query->paginate($params['paginate']);
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

            if (!empty($where['id'])) {
                $query->where('id', '=', $where['id']);
            }

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
