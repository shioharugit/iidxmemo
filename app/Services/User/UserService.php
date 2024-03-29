<?php

namespace App\Services\User;

use App\Models\User as User;
use App\Models\Memo as Memo;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class UserService
{
    private $user;
    private $memo;

    public function __construct()
    {
        $this->user = new User();
        $this->memo = new Memo();
    }

    /**
     * ユーザー仮登録処理
     * @param $request
     */
    public function createPreregisterData($request)
    {
        $data = [
            'email' => $request->email,
            'email_verify_token' => base64_encode($request->email),
        ];

        DB::beginTransaction();
        try {
            // 仮登録データが存在しない場合のみ仮登録データを作成
            if ($this->user->where('email', $request->email)
                ->whereNull('email_verified_at')
                ->whereNull('deleted_at')
                ->doesntExist()) {
                $this->user->createUser($data);
            }
            $email = new EmailVerification($data);
            Mail::to([$data['email']])->send($email);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('ユーザー仮登録中に例外が発生しました。');
            abort(500);
        }
        DB::commit();
    }

    /**
     * ユーザー登録の仮登録ユーザー取得
     * @param $email_verify_token
     * @return mixed
     */
    public function getPreregisterUser($email_verify_token)
    {
        $params = [
            'deleted_at_is_null' => true,
            'email_verified_at_is_null' => true,
            'email_verify_token' => $email_verify_token,
        ];
        $users = $this->user->getUser($params);

        return $users->first();
    }

    /**
     * ユーザー登録処理
     * (仮登録中のユーザーを本登録する)
     * @param $request
     * @param $user
     * @return mixed
     */
    public function createUser($request, $user)
    {
        $data = [
            'login_id' => $request->login_id,
            'password' => Hash::make($request->password),
            'email_verified_at' => date(config('const.DEFAULT_DATE_FORMAT')),
            'email_verify_token' => null,
        ];
        $where = [
            'id' => $user->id,
        ];
        $this->user->updateUser($data, $where);
    }

    /**
     * ユーザー更新のユーザー取得
     * @return mixed
     */
    public function getEditUser()
    {
        $params = [
            'id' => Auth::user()->id,
            'deleted_at_is_null' => true,
        ];
        $users = $this->user->getUser($params);

        return $users->first();
    }

    /**
     * ユーザー更新処理
     * @param $request
     * @return mixed
     */
    public function updateUser($request)
    {
        $data = [
            'login_id' => $request->login_id,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $where = [
            'id' => Auth::user()->id,
        ];

        return $this->user->updateUser($data, $where);
    }

    /**
     * ユーザー削除処理
     * @return mixed
     */
    public function deleteUser()
    {
        $data = [
            'deleted_at' => date(config('const.DEFAULT_DATE_FORMAT'))
        ];
        $where = [
            'id' => Auth::user()->id,
        ];
        return $this->user->updateUser($data, $where);
    }

    /**
     * ユーザーに現時点の収録楽曲分のメモのレコードを作成する
     * @param $user_id
     * @return array|bool
     */
    public function createUserMemo($user_id)
    {
        return $this->memo->createUserMemo($user_id);
    }
}
