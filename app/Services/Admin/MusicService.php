<?php

namespace App\Services\Admin;

use App\Models\Music as Music;

class MusicService
{
    private $music;

    public function __construct()
    {
        $this->music = new Music();
    }

    /**
     * 楽曲一覧処理
     * @param $request
     * @return mixed
     */
    public function getMusic($request)
    {
        $params = [
            'title' => $request->title,
            'genre' => $request->genre,
            'artist' => $request->artist,
            'version' => $request->version,
            'deleted_at_is_null' => true,
            'paginate' => config('const.MUSIC_DISPLAY_LIMIT'),
        ];

        return $this->music->getMusic($params);
    }

    /**
     * 楽曲登録処理
     * @param $request
     * @return mixed
     */
    public function createMusic($request)
    {
        $data = [
            'version' => $request->version,
            'title' => $request->title,
            'genre' => $request->genre,
            'artist' => $request->artist,
            'bpm' => $request->bpm,
            'popular_name' => $request->popular_name,
            'sp_beginner' => $request->sp_beginner,
            'sp_normal' => $request->sp_normal,
            'sp_hyper' => $request->sp_hyper,
            'sp_another' => $request->sp_another,
            'sp_leggendaria' => $request->sp_leggendaria,
            'dp_beginner' => $request->dp_beginner,
            'dp_normal' => $request->dp_normal,
            'dp_hyper' => $request->dp_hyper,
            'dp_another' => $request->dp_another,
            'dp_leggendaria' => $request->dp_leggendaria,
        ];

        return $this->music->createMusic($data);
    }

    /**
     * 楽曲更新の楽曲取得
     * @param $music_id
     * @return mixed
     */
    public function getEditMusic($music_id)
    {
        $params = [
            'id' => $music_id,
            'deleted_at_is_null' => true,
        ];
        $users = $this->music->getMusic($params);

        return $users->first();
    }

    /**
     * 楽曲更新処理
     * @param $request
     * @param $music_id
     * @return mixed
     */
    public function updateMusic($request, $music_id)
    {
        $data = [
            'version' => $request->version,
            'title' => $request->title,
            'genre' => $request->genre,
            'artist' => $request->artist,
            'bpm' => $request->bpm,
            'popular_name' => $request->popular_name,
            'sp_beginner' => $request->sp_beginner,
            'sp_normal' => $request->sp_normal,
            'sp_hyper' => $request->sp_hyper,
            'sp_another' => $request->sp_another,
            'sp_leggendaria' => $request->sp_leggendaria,
            'dp_beginner' => $request->dp_beginner,
            'dp_normal' => $request->dp_normal,
            'dp_hyper' => $request->dp_hyper,
            'dp_another' => $request->dp_another,
            'dp_leggendaria' => $request->dp_leggendaria,
        ];

        $where = [
            'id' => $music_id,
        ];

        return $this->music->updateMusic($data, $where);
    }

    /**
     * 楽曲削除処理
     * @param $music_id
     * @return mixed
     */
    public function deleteMusic($music_id)
    {
        $data = [
            'deleted_at' => date(config('const.DEFAULT_DATE_FORMAT'))
        ];
        $where = [
            'id' => $music_id,
        ];
        return $this->music->updateMusic($data, $where);
    }
}
