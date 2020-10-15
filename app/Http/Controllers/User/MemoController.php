<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MemoIndexRequest;
use App\Http\Requests\User\MemoEditRequest;
use App\Http\Requests\User\MemoMusicSearchRequest;
use App\Services\User\MemoService as MemoService;
use App\Services\User\MusicService as MusicService;

class MemoController extends Controller
{
    private $memo;
    private $music;

    public function __construct()
    {
        $this->memo = new MemoService();
        $this->music = new MusicService();
    }

    /**
     * メモ一覧
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.memo.index');
    }

    /**
     * ユーザーの持つメモをJsonで返却する
     * @param MemoIndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(MemoIndexRequest $request)
    {
        $memo = $this->memo->getMemo($request);
        return response()->json($memo, 200);
    }

    /**
     * 楽曲検索結果をJsonで返却する
     * @param MemoMusicSearchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(MemoMusicSearchRequest $request)
    {
        $music = $this->music->getMusic($request);
        return response()->json($music, 200);
    }

    /**
     * メモ登録処理
     * @param $music_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($music_id)
    {
        $music = $this->music->getMusicByMusicId($music_id);
        if (empty($music)) {
            $params = ['errors' => ['楽曲が見つかりませんでした。']];
            return response()->json($params, 404);
        }
        $this->memo->createMemo($music_id);
        $params = ['messages' => 'メモを登録しました。'];

        return response()->json($params, 200);
    }

    /**
     * メモ更新処理
     * @param MemoEditRequest $request
     * @param $memo_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MemoEditRequest $request, $memo_id)
    {
        $memo = $this->memo->getEditMemo($memo_id);
        if (empty($memo)) {
            $params = ['errors' => ['メモが見つかりませんでした。']];
            return response()->json($params, 404);
        }
        $this->memo->updateMemo($request, $memo_id);
        $params = ['messages' => 'メモを更新しました。'];

        return response()->json($params, 200);
    }

    /**
     * メモ削除処理
     * @param $memo_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($memo_id)
    {
        $memo = $this->memo->getEditMemo($memo_id);
        if (empty($memo)) {
            $params = ['errors' => ['メモが見つかりませんでした。']];
            return response()->json($params, 404);
        }
        $this->memo->deleteMemo($memo_id);
        $params = ['messages' => 'メモを一覧から削除しました。'];

        return response()->json($params, 200);
    }
}
