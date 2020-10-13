<?php

namespace App\Models;

use App\Notifications\UserPasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login_id',
        'email',
        'email_verified_at',
        'email_verify_token',
        'password',
        'remember_token',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserPasswordResetNotification($token));
    }

    /**
     * ユーザーを取得する
     * @param $params
     * @return mixed
     */
    public function getUser($params)
    {
        $query = User::select('*');

        if (!empty($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        if (!empty($params['login_id'])) {
            $query->where('login_id', 'LIKE', '%' . $params['login_id'] . '%');
        }

        if (!empty($params['email'])) {
            $query->where('email', 'LIKE', '%' . $params['email'] . '%');
        }

        if (!empty($params['deleted_at_is_null'])) {
            $query->whereNull('deleted_at');
        }

        if (!empty($params['email_verified_at_is_null'])) {
            $query->whereNull('email_verified_at');
        }

        if (!empty($params['email_verify_token'])) {
            $query->where('email_verify_token', '=', $params['email_verify_token']);
        }

        if (!empty($params['order_by']['column']) && !empty($params['order_by']['sort'])) {
            $query->orderBy($params['order_by']['column'], $params['order_by']['sort']);
        } else {
            $query->orderBy('id', 'DESC');
        }

        return $query->paginate(config('const.USER_DISPLAY_LIMIT'));
    }

    /**
     * ユーザー登録処理
     * @param $data
     * @return mixed
     */
    public function createUser($data)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $result = User::insert($data);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('ユーザー登録中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }

    /**
     * ユーザー更新処理
     * @param $data
     * @param $where
     * @return mixed
     */
    public function updateUser($data, $where)
    {
        $result = [];
        DB::beginTransaction();
        try {
            $query = User::query();

            if (!empty($where['id'])) {
                $query->where('id', '=', $where['id']);
            }

            $result = $query->update($data);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('ユーザー更新中に例外が発生しました:' . $e->getMessage());
            abort(500);
        }
        DB::commit();
        return $result;
    }
}
