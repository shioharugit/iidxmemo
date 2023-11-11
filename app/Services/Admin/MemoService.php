<?php

namespace App\Services\Admin;

use App\Models\Memo as Memo;
use App\Models\User as User;

class MemoService
{
    private $memo;
    private $user;

    public function __construct()
    {
        $this->memo = new Memo();
        $this->user = new User();
    }

    /**
     * メモ登録処理
     * @return mixed
     */
    public function createMemo()
    {
        $params = [
            'deleted_at_is_null' => true,
            'email_verified_at_is_not_null' => true,
        ];
        $users = $this->user->getUser($params);

        foreach ($users as $user) {
            $this->memo->createUserMemo($user->id);
        }
    }
}
