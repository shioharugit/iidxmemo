<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MusicIndexRequest;
use App\Http\Requests\Admin\MusicCreateRequest;
use App\Http\Requests\Admin\MusicEditRequest;
use App\Http\Controllers\Controller;
use App\Services\Admin\MusicService as MusicService;

class MusicController extends Controller
{
    private $music;

    public function __construct()
    {
        $this->music = new MusicService();
    }

    /**
     * 楽曲一覧
     * @param MusicIndexRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(MusicIndexRequest $request)
    {
        $musics = $this->music->getMusic($request);
        return view('admin.music.index', ['musics' => $musics, 'request' => $request]);
    }

    /**
     * 楽曲新規登録
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.music.create');
    }

    /**
     * 楽曲登録処理
     * @param MusicCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MusicCreateRequest $request)
    {
        $this->music->createMusic($request);
        session()->flash('status', '楽曲を登録しました。');

        return redirect()->route('admin.music.create');
    }

    /**
     * 楽曲更新
     * @param $music_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($music_id)
    {
        $music = $this->music->getEditMusic($music_id);
        if (empty($music)) {
            return redirect()->route('admin.music.index');
        }

        return view('admin.music.edit', ['music' => $music,]);
    }

    /**
     * 楽曲更新処理
     * @param MusicEditRequest $request
     * @param $music_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MusicEditRequest $request, $music_id)
    {
        $music = $this->music->getEditMusic($music_id);
        if (empty($music)) {
            return redirect()->route('admin.music.index');
        }

        $this->music->updateMusic($request, $music_id);
        session()->flash('status', '楽曲を更新しました。');

        return redirect()->route('admin.music.edit', $music_id);
    }

}
