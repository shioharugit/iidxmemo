<?php

namespace App\Services\User;

use App\Models\Music as Music;

class MusicService
{
    private $music;

    public function __construct()
    {
        $this->music = new Music();
    }

    /**
     * 楽曲検索処理
     * @param $request
     * @return mixed
     */
    public function getMusic($request)
    {
        $params = [
            'version' => $request->version,
            'free' => $request->free,
            'sp_difficulty' => $request->sp_difficulty,
            'dp_difficulty' => $request->dp_difficulty,
            'deleted_at_is_null' => true,
            'order_by' => [
                'column' => 'title',
                'sort' => 'ASC',
            ],
        ];

        return $this->music->getMusic($params);
    }

    /**
     * 楽曲IDと一致する楽曲を取得
     * @param $music_id
     * @return mixed
     */
    public function getMusicByMusicId($music_id)
    {
        $params = [
            'id' => $music_id,
            'deleted_at_is_null' => true,
        ];

        return $this->music->getMusic($params);
    }
}
