<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserIndexRequest;
use App\Models\User;
use App\Services\Admin\UserService as UserService;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserService();
    }

    /**
     * ユーザー一覧
     * @param UserIndexRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(UserIndexRequest $request)
    {
        $users = $this->user->getUser($request);
        return view('admin.user.index', ['users' => $users, 'request' => $request]);
    }

    /**
     * ユーザー新規登録
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * ユーザー登録処理
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $this->user->createUser($request);
        session()->flash('status', 'ユーザーを登録しました。');

        return redirect()->route('admin.user.create');
    }

    /**
     * ユーザー更新
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($user_id)
    {
        $user = $this->user->getEditUser($user_id);
        if (empty($user)) {
            return redirect()->route('admin.user.index');
        }

        return view('admin.user.edit', ['user' => $user,]);
    }

    /**
     * ユーザー更新処理
     * @param UserEditRequest $request
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserEditRequest $request, $user_id)
    {
        $user = $this->user->getEditUser($user_id);
        if (empty($user)) {
            return redirect()->route('admin.user.index');
        }

        $this->user->updateUser($request, $user_id);
        session()->flash('status', 'ユーザーを更新しました。');

        return redirect()->route('admin.user.edit', $user_id);
    }

    /**
     * ユーザー削除
     * @param $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function destroy($user_id)
    {
        $user = $this->user->getEditUser($user_id);
        if (empty($user)) {
            return redirect()->route('admin.user.index');
        }
        $this->user->deleteUser($user_id);
        session()->flash('status', 'ユーザーを削除しました。');

        return redirect()->route('admin.user.index');
    }
}
