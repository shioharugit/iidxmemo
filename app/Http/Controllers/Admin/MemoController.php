<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\MemoService as MemoService;

class MemoController extends Controller
{
    private $memo;

    public function __construct()
    {
        $this->memo = new MemoService();
    }

    /**
     * メモ登録
     * （ユーザーに収録楽曲分のメモを作成する）
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.memo.create');
    }

    /**
     * メモ登録処理
     * （ユーザーに収録楽曲分のメモを作成する）
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $this->memo->createMemo();
        session()->flash('status', 'ユーザーに収録楽曲分のメモを登録しました。');

        return redirect()->route('admin.memo.create');
    }


}
