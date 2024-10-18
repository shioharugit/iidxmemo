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
     * ユーザーに紐づくメモを取得する
     * @param $params
     * @return mixed
     */
    public function getMemo($params)
    {
        $query = Music::select(
            'memos.id AS memo_id',
            'memos.user_id',
            'memos.music_id',
            'memos.memo',
            'memos.check_flag',
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
            ->leftJoin('memos', function ($join) {
                $join->on('memos.music_id', '=', 'musics.id');
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

        if (!empty($params['musics_deleted_at_is_null'])) {
            $query->whereNull('musics.deleted_at');
        }

        if (!empty($params['version']) && is_array($params['version'])) {
            $query->whereIn('musics.version', $params['version']);
        }

        if (!empty($params['search_sp_difficulty']) && is_array($params['search_sp_difficulty'])) {
            $sp_difficulty = $params['search_sp_difficulty'];
            $query->where(function ($query) use ($sp_difficulty) {
                $query->orWhereIn('sp_beginner', $sp_difficulty)
                    ->orWhereIn('sp_normal', $sp_difficulty)
                    ->orWhereIn('sp_hyper', $sp_difficulty)
                    ->orWhereIn('sp_another', $sp_difficulty)
                    ->orWhereIn('sp_leggendaria', $sp_difficulty);
            });
        }

        if (!empty($params['search_dp_difficulty']) && is_array($params['search_dp_difficulty'])) {
            $dp_difficulty = $params['search_dp_difficulty'];
            $query->where(function ($query) use ($dp_difficulty) {
                $query->orWhereIn('dp_beginner', $dp_difficulty)
                    ->orWhereIn('dp_normal', $dp_difficulty)
                    ->orWhereIn('dp_hyper', $dp_difficulty)
                    ->orWhereIn('dp_another', $dp_difficulty)
                    ->orWhereIn('dp_leggendaria', $dp_difficulty);
            });
        }

        if (isset($params['memo_not_null'])) {
            $query->whereNotNull('memos.memo');
        }

        if (isset($params['memo_is_null'])) {
            $query->whereNull('memos.memo');
        }

        if (isset($params['check_flag'])) {
            $query->where('memos.check_flag', '=', $params['check_flag']);
        }

        if (!empty($params['search_free'])) {
            $free = $params['search_free'];
            $query->where(function ($query) use ($free) {
                $query->orWhere('title', 'LIKE', '%' . $free . '%')
                    ->orWhere('genre', 'LIKE', '%' . $free . '%')
                    ->orWhere('artist', 'LIKE', '%' . $free . '%')
                    ->orWhere('popular_name', 'LIKE', '%' . $free . '%');
            });
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

    /**
     * ユーザーに現時点の収録楽曲分のメモのレコードを作成する
     * @param $user_id
     * @return array|bool
     */
    public function createUserMemo($user_id)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $params = [
                'select_user_id' => $user_id,
                'where_user_id' => $user_id,
            ];
            $query = 'INSERT INTO memos (user_id, music_id)
                SELECT :select_user_id, musics.id
                FROM musics
                WHERE musics.deleted_at IS NULL
                    AND musics.id NOT IN(SELECT memos.music_id FROM memos WHERE memos.user_id = :where_user_id);';
            $result = DB::insert($query, $params);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('ユーザーに現時点の収録楽曲分のメモ登録中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }
}
