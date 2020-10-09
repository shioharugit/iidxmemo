<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPreregisterRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserService();
    }

    /**
     * ユーザー仮登録
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function preregister()
    {
        return view('user.user.preregister');
    }

    /**
     * ユーザー仮登録処理
     * @param UserPreregisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(UserPreregisterRequest $request)
    {
        $this->user->createPreregisterData($request);
        session()->flash('messages', ['メールを送信しました。']);
        return redirect()->route('user.preregister');
    }
}
