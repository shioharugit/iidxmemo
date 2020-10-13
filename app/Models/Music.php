<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class Music extends Model
{
    protected $table = 'musics';

    /**
     * 楽曲を取得する
     * @param $params
     * @return mixed
     */
    public function getMusic($params)
    {
        $query = Music::select('*');

        if (!empty($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        if (!empty($params['title'])) {
            $query->where('title', 'LIKE', '%' . $params['title'] . '%');
        }

        if (!empty($params['genre'])) {
            $query->where('genre', 'LIKE', '%' . $params['genre'] . '%');
        }

        if (!empty($params['artist'])) {
            $query->where('artist', 'LIKE', '%' . $params['artist'] . '%');
        }

        if (isset($params['version'])) {
            $query->where('version', '=', $params['version']);
        }

        if (!empty($params['deleted_at_is_null'])) {
            $query->whereNull('deleted_at');
        }

        return $query->paginate(config('const.MUSIC_DISPLAY_LIMIT'));
    }

    /**
     * 楽曲登録処理
     * @param $data
     * @return mixed
     */
    public function createMusic($data)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $result = Music::insert($data);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('楽曲登録中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }

    /**
     * 楽曲更新処理
     * @param $data
     * @param $where
     * @return mixed
     */
    public function updateMusic($data, $where)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $query = Music::query();

            if (!empty($where['id'])) {
                $query->where('id', '=', $where['id']);
            }

            $result = $query->update($data);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('楽曲更新中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }
}
