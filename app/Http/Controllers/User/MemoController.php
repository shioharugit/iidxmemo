<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
}
