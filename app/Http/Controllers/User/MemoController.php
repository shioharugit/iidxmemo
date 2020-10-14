<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MemoIndexRequest;
use App\Http\Requests\User\MemoEditRequest;
use App\Services\User\MemoService as MemoService;


class MemoController extends Controller
{
    private $memo;

    public function __construct()
    {
        $this->memo = new MemoService();
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
        return response()->json($memo ,200);
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
            return response()->json($params ,404);
        }
        $this->memo->updateMemo($request, $memo_id);
        $params = ['messages' => 'メモを更新しました。'];

        return response()->json($params ,200);
    }
}
