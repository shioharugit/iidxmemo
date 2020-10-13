<?php

namespace App\Services\User;

use App\Models\Memo as Memo;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class MemoService
{
    private $memo;

    public function __construct()
    {
        $this->memo = new Memo();
    }

    /**
     * ユーザーのメモを取得する
     * @param $request
     * @return mixed
     */
    public function getMemo($request)
    {
        $params = [
            'user_id' => Auth::user()->id,
        ];

        return $this->memo->getMemo($params);
    }
}
