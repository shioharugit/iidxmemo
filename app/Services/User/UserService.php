<?php

namespace App\Services\User;

use App\Models\User as User;
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

    public function __construct()
    {
        $this->user = new User();
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
}
