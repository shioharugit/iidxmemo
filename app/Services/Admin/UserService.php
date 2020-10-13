<?php

namespace App\Services\Admin;

use App\Models\User as User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * ユーザー一覧処理
     * @param $request
     * @return mixed
     */
    public function getUser($request)
    {
        $params = [
            'login_id' => $request->login_id,
            'email' => $request->email,
            'deleted_at_is_null' => true,
        ];

        return $this->user->getUser($params);
    }

    /**
     * ユーザー登録処理
     * @param $request
     * @return mixed
     */
    public function createUser($request)
    {
        $data = [
            'email' => $request->email,
            'login_id' => $request->login_id,
            'password' => Hash::make($request->password),

            // 管理画面から登録した場合、メール認証済とする
            'email_verified_at' => date(config('const.DEFAULT_DATE_FORMAT')),
        ];

        return $this->user->createUser($data);
    }

    /**
     * ユーザー更新のユーザー取得
     * @param $user_id
     * @return mixed
     */
    public function getEditUser($user_id)
    {
        $params = [
            'id' => $user_id,
            'deleted_at_is_null' => true,
        ];
        $users = $this->user->getUser($params);

        return $users->first();
    }

    /**
     * ユーザー更新処理
     * @param $request
     * @param $user_id
     * @return mixed
     */
    public function updateUser($request, $user_id)
    {
        $data = [
            'email' => $request->email,
            'login_id' => $request->login_id,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $where = [
            'id' => $user_id,
        ];

        return $this->user->updateUser($data, $where);
    }

    /**
     * ユーザー削除処理
     * @param $user_id
     * @return mixed
     */
    public function deleteUser($user_id)
    {
        $data = [
            'deleted_at' => date(config('const.DEFAULT_DATE_FORMAT'))
        ];
        $where = [
            'id' => $user_id,
        ];
        return $this->user->updateUser($data, $where);
    }
}
