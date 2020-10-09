<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPreregisterRequest;
use App\Http\Requests\User\UserCreateRequest;
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

    /**
     * ユーザー新規登録
     * @param $email_verify_token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($email_verify_token)
    {
        $user = $this->user->getPreregisterUser($email_verify_token);

        $invalid_message = false;
        if (empty($user)) {
            $invalid_message = true;
        }

        return view('user.user.create', [
            'user' => $user,
            'invalid_message' => $invalid_message,
            'email_verify_token' => $email_verify_token,
        ]);
    }

    /**
     * ユーザー登録処理
     * @param UserCreateRequest $request
     * @param $email_verify_token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request, $email_verify_token)
    {
        $user = $this->user->getPreregisterUser($email_verify_token);
        if (empty($user)) {
            return redirect()->route('user.login');
        }
        $this->user->createUser($request, $user);
        session()->flash('messages', ['ユーザーの登録が完了しました。ログインしてサービスをご利用ください。']);

        return redirect()->route('user.login');
    }
}
