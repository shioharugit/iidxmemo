<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserPreregisterRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserEditRequest;
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
        $this->user->createUserMemo($user->id);
        session()->flash('messages', ['ユーザーの登録が完了しました。ログインしてサービスをご利用ください。']);

        return redirect()->route('user.login');
    }

    /**
     * ユーザー更新
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit()
    {
        $user = $this->user->getEditUser();
        if (empty($user)) {
            return redirect()->route('user.memo.index');
        }

        return view('user.user.edit', ['user' => $user,]);
    }

    /**
     * ユーザー更新処理
     * @param UserEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request)
    {
        $user = $this->user->getEditUser();
        if (empty($user)) {
            return redirect()->route('user.memo.index');
        }

        $this->user->updateUser($request);
        session()->flash('status', 'ユーザーを更新しました。');

        return redirect()->route('user.edit');
    }

    /**
     * ユーザー退会
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destroy()
    {
        $user = $this->user->getEditUser();
        if (empty($user)) {
            return redirect()->route('user.memo.index');
        }
        $this->user->deleteUser();
        session()->flash('status', 'ユーザーを削除しました。');

        return redirect()->route('user.logout');
    }
}
