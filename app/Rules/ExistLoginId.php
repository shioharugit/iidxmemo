<?php

namespace App\Rules;

use App\Models\User as User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Route;

class ExistLoginId implements Rule
{
    protected $attributes = [];

    /**
     * ExistEmail constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = new User();

        if (Route::currentRouteName() === 'admin.user.update') {
            // 管理画面側ユーザー更新の場合
            $uri = $_SERVER['REQUEST_URI'];
            $tmp = explode('/', $uri);
            $user_id = $tmp[count($tmp) - 1];
            return $user->where('login_id', '=', $this->attributes['login_id'])
                ->where('id', '!=', $user_id)
                ->whereNotNull('email_verified_at')
                ->whereNull('deleted_at')
                ->doesntExist();
        } elseif (Route::currentRouteName() === 'user.update') {
            // ユーザー更新の場合
            return $user->where('login_id', $this->attributes['login_id'])
                ->where('id', '!=', Auth::user()->id)
                ->whereNotNull('email_verified_at')
                ->whereNull('deleted_at')
                ->doesntExist();
        }

        return $user->where('login_id', $this->attributes['login_id'])
            ->whereNotNull('email_verified_at')
            ->whereNull('deleted_at')
            ->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeが登録済です。';
    }
}
